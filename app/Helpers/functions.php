<?php
use Illuminate\Http\JsonResponse;
use phpDocumentor\Reflection\DocBlock;

/**
 * Return a successful JSON response
 *
 * @param array $payload
 * @param string $message
 * @param integer $status
 * @return JsonResponse
 */
function respondWithSuccess($payload = [], $message = 'Successful', $status = 200): JsonResponse
{
    return response()->json(['success' => true, 'message' => $message,  'payload' => $payload], $status);
}

/**
 * Return a successful JSON response
 *
 * @param array $payload
 * @param string $message
 * @param integer $status
 * @return JsonResponse
 */
function respondWithError($payload = [], $message = 'An erorr occured', $status = 500): JsonResponse
{
    return response()->json(['success' => false, 'message' => $message,  'payload' => $payload], $status);
}

/**
 * Undocumented function
 *
 * @param float $amount
 * @param integer $dp
 * @return string
 */
function toMoney(float $amount = 0, int $dp = 2): string
{
    return number_format($amount, $dp);
}

/**
 * Undocumented function
 *
 * @param float $amount
 * @param integer $dp
 * @return string
 */
function toNaira(float $amount = 0, int $dp = 2): string
{
    return  $amount < 0 ? '-₦' . toMoney(abs($amount), $dp) : '₦' . toMoney($amount, $dp);
}


/**
 * Generate the URL to a named hrm route
 *
 * @param array|string $route
 * @param mixed $parameters
 * @param bool $absolute
 * @return string
 */
function hrmRoute($route, $parameters = [], bool $absolute = true): string
{
    return route('hrm.' . $route, $parameters, $absolute);
}

/**
 * Undocumented function
 *
 * @param string $view
 * @param \Illuminate\Contracts\Support\Arrayable|array $data
 * @param array $mergeData
 * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
 */
function hrmView(string $view, $data = [], array $mergeData = [])
{
    return view('hrm.' . $view, $data, $mergeData);
}




function generateReceiptNo($no, $prefix = 'RE', $chars = 9, $padChar = '000000000', $pad = 'left')
{
    $recieptNo =  str_pad($no, $chars, "$prefix$padChar", STR_PAD_LEFT);
    if (strlen(strval($no)) >= $chars) $recieptNo = "$prefix" . $recieptNo;
    return $recieptNo;
}

function displayPhone($phone){
    $intl_format = substr($phone, 1); //returns 8032537302
    //now add 234 to intl_format
    $intl_format = sprintf("%s%s", "234", $intl_format);
    return intval($intl_format);
}
