<?php namespace ENA\PHPIPAMAPI;

use ENA\PHPIPAMAPI\Error\ApiError;
use Psr\Http\Message\ResponseInterface;

/**
 * TODO: Not super happy with this, the difference between "Response" and "Error" in this lib is not great enough.
 *
 * Class Response
 * @package ENA\PHPIPAMAPI
 */
class Response {
    /** @var int */
    public $code = 0;
    /** @var bool */
    public $success = false;
    /** @var null */
    public $data = null;
    /** @var string */
    public $time = '';

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     * @return array(
     * @type \ENA\PHPIPAMAPI\Response   Decoded response, if no errors were seen
     * @type \ENA\PHPIPAMAPI\Error      Error description, if encountered
     * )
     */
    public static function fromPSR7Response(ResponseInterface $response): array {
        $n = new static();
        $n->code = $response->getStatusCode();
        $contents = $response->getBody()->getContents();
        $decoded = json_decode($contents, true);
        if (JSON_ERROR_NONE === json_last_error()) {
            if (is_array($decoded)) { // TODO: better test for root object
                if (isset($decoded['code']) &&
                    isset($decoded['success']) &&
                    // TODO: are there responses that are "OK" but have something other than a "data" field?
                    isset($decoded['data']) &&
                    isset($decoded['time'])) {
                    $n->code = $decoded['code'];
                    $n->success = $decoded['success'];
                    $n->data = $decoded['data'];
                    $n->time = $decoded['time'];
                    return [$n, null];
                } else {
                    return [
                        null,
                        new ApiError(-1, sprintf(
                            'Response expected to have fields ["code","success","data","error"], saw ["%s"]',
                            implode('","', array_keys($decoded))
                        )),
                    ];
                }
            } else {
                return [
                    null,
                    new ApiError(-1, sprintf(
                        'Response expected to be json-encoded object, saw "%s"',
                        gettype($decoded)
                    )),
                ];
            }
        } else {
            return [
                null,
                new ApiError(-1, sprintf(
                    'Response returned invalid JSON: %s',
                    $contents
                )),
            ];
        }
    }
}