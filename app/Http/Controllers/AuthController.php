<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Http\Request;
use App\User;
use illuminate\SUpport\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laminas\Diactoros\ServerRequest;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Laravel\Passport\Passport;
use Laravel\Passport\TokenRepository;
use League\OAuth2\Server\AuthorizationServer;
use Psr\Http\Message\ServerRequestInterface;
use Lcobucci\JWT\Parser as JwtParser;
use Validator;
use App\Constants;

class AuthController extends AccessTokenController
{
    public function __construct(AuthorizationServer $server,
                                TokenRepository $tokens,
                                JwtParser $jwt)
    {
        parent::__construct($server, $tokens, $jwt);
    }

    /**
     * API Register
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
            'role' => 'in:author,reader'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], Constants::STATUS_UNAUTHORIZED);
        }

        $receiveNotifications = $request->has('receive_notifications') ? $request->receive_notifications : "0";

        if ($request->role === 'author')
            $receiveNotifications = "0";

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'receive_notifications' => $receiveNotifications
        ]);

        return response()->json([
            'message' => 'Successfully created user!'
        ], Constants::STATUS_OBJECT_CREATED);
    }

    /**
     * Login user and create token
     * @return \Illuminate\Http\JsonResponse
     */
//    public function login(Request $request)
    public function login(ServerRequestInterface $request)
    {
        $parsedBody = $request->getParsedBody();
        $client = $this->getClient();

        if (is_null($client))
            return response()->json([
                'message' => Constants::NO_PASSWORD_CLIENT_SET
            ], Constants::STATUS_BAD_REQUEST);

        $parsedBody['username'] = isset($parsedBody['email']) ? $parsedBody['email'] : '';
        $parsedBody['grant_type'] = 'password';
        $parsedBody['client_id'] = $client->id;
        $parsedBody['client_secret'] = $client->secret;

        // since it is not required by passport
        unset($parsedBody['email'], $parsedBody['client_name']);

        return parent::issueToken($request->withParsedBody($parsedBody));
    }

    /**
     * Get active password client for issuing tokens
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|object|null
     */
    private function getClient()
    {
        return DB::table('oauth_clients')
            ->where([
                    ['password_client', 1],
                    ['revoked', 0]
                ]
            )
            ->first();
    }

    /**
     * Loggs out a current authentiacted user
     * @param ServerRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    /*public function logout(ServerRequest $request)
    {
        $client = $this->getClient();
        $token = auth()->user()
            ->tokens
            ->where('client_id', $client->id)
            ->first();

        abort_if(is_null($token), 400, 'Token for the given client name does not exist');

        $token->delete();

        return response()->json('Logged out successfully', 200);
    }*/

    /**
     * Refreshes the access and refresh tokens by a given refresh token
     * @param ServerRequestInterface $request
     * @return \Illuminate\Http\Response
     */
    public function refreshToken(ServerRequestInterface $request)
    {
        $parsedBody = $request->getParsedBody();

        $client = $this->getClient();

        $parsedBody['grant_type'] = 'refresh_token';
        $parsedBody['client_id'] = $client->id;
        $parsedBody['client_secret'] = $client->secret;

        return parent::issueToken($request->withParsedBody($parsedBody));
    }

    /**
     * Get the authenticated user
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function details(Request $request)
    {
        return response()->json($request->user());
    }
}
