<?php

 

class utils {
    /**
     * Returns a random integer between the given range
     *
     * @param int $min=1
     * @param int $max=100
     * @return int
     */
    public static function getSecureRandom(int $min, int $max): int {
        $range = $max - $min;
        $range_log = log($range, 2);
        $bytes_to_fetch = (int) ($range_log / 8) + 1;
        $bits_to_fetch = (int) $range_log + 1;
        $rng_filter = (1 << $bits_to_fetch) - 1;

        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes_to_fetch)));
            $rnd = $rnd & $rng_filter;
        } while ($rnd > $range);

        return $min + $rnd;
    }
}

?>
