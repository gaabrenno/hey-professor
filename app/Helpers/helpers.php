<?php

use App\Actions\Bank\GetByCode;
use App\Models\{SystemSettingData, User};
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

/**
 * Check if the value is null or empty.
 */
function isNullOrEmpty($value): bool
{
    return ($value === null || trim($value) === '');
}

function user(): ?User
{
    return Auth::check() ? Auth::user() : null;
}

/**
 * Remove all non-numeric characters from the text.
 */
function onlyNumbers($text)
{
    if (isNullOrEmpty($text)) {
        $text = "";
    }

    return preg_replace('/[^0-9]/is', '', $text);
}

/**
 * Check if the key exists in the array and if it is not null or empty.
 */
function hasKeyAndValue(string | int $key, mixed $array): bool
{
    return (isset($array[$key]) && !isNullOrEmpty($array[$key]));
}

/**
 * Check if the key exists in the array and if it is array.
 */
function hasKeyAndIsArray(string | int $key, mixed $array): bool
{
    return (isset($array[$key]) && is_array($array[$key]));
}

/**
 * Function to convert text database to default textarea.
 */
function get_textarea_value($textarea)
{
    $textarea = str_replace(["\\r\\n", "\\R\\N"], "\n", $textarea);
    $textarea = str_replace("\\", "", $textarea);

    return nl2br($textarea);
}

// function getBankName($bankNumber): string
// {
//     return GetByCode::execute($bankNumber);
// }

// function systemSettings(): Collection
// {
//     return SystemSettingData::getSettings();
// }

/**
 * Generate a UUID.
 */
function uuid()
{
    return (string) Str::uuid();
}
