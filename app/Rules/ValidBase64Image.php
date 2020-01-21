<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidBase64Image implements Rule
{
    /**
     * @var int
     */
    private $imageSize;

    /**
     * @var array
     */
    private $imageTypes;

    /**
     * @var string
     */
    private $errorMessage = 'The validation error message.';

    /**
     * Create a new rule instance.
     * @param int $imageSize
     * @param array $imageTypes
     * @return void
     */
    public function __construct(int $imageSize = 0, array $imageTypes = ['jpg'])
    {
        $this->imageSize = $imageSize;
        $this->imageTypes = $imageTypes;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $regexResult = preg_match('/^data:image\/(' . implode('|', $this->imageTypes) . ');base64,(.+)$/', $value, $matches);
        if(!$regexResult) {
            $this->errorMessage = "The " . $attribute . " field is not a valid base64 image representation.";
            return false;
        }

        if (count($matches) != 3) {
            $this->errorMessage = "The " . $attribute . " field is not of type: " . implode(', ', $this->imageTypes) . '.';
            return false;
        }

        $imageData = $matches[2];
        if (!base64_decode($imageData)) {
            $this->errorMessage = "The " . $attribute . " field do not contain a valid base64 encoded image.";
            return false;
        }

        $imageSize = $this->calculateImageSize($imageData);
        if($imageSize > $this->imageSize) {
            $this->errorMessage = "The " . $attribute . " field exceeds the maximum available size in bytes [" . $this->imageSize . "].";
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->errorMessage;
    }

    /**
     * Calculates a base64 encoded image size in bytes
     * @param string $image
     * @return int
     */
    private function calculateImageSize(string $image) : int
    {
        $padding = 0;
        if (substr($image, -2) == "==")
            $padding = 2;
        else if (substr($image, -1) == "=")
            $padding = 1;

        $stringLength = strlen($image);
        $inBytes = ($stringLength / 4) * 3 - $padding;
        return $inBytes;
    }
}
