<?php
class Dizziness {
    private $dizziness_key;
    private $target_blocks;
    private $repeats;

    public function __construct($dizziness_key, $target_blocks, $repeats) {
        $this->dizziness_key = $dizziness_key;
        $this->target_blocks = $target_blocks;
        $this->repeats = $repeats;
    }

    public function hash($input) {
        $final_hash = $this->generate_blocks($input);
        return $this->format_hash($final_hash);
    }

    public static function generate_dizziness_hash($input, $dizziness_key, $target_blocks, $repeats) {
        $hasher = new self($dizziness_key, $target_blocks, $repeats);
        return $hasher->hash($input);
    }

    private function format_hash($hash) {
        return $this->repeats . '#' . $this->dizziness_key . '#' . $hash . '#' . $this->target_blocks;
    }

    private function simple_hash($input) {
        return hash('sha256', $input);
    }

    private function bitwise_mix($data, $pattern) {
        $length = strlen($data);
        $result = array_fill(0, $length, null);
        $used_indices = [];

        for ($i = 0; $i < $length; $i++) {
            $pattern_index = ord($pattern[$i]) % $length;

            while (in_array($pattern_index, $used_indices)) {
                $pattern_index = ($pattern_index + 1) % $length;
            }

            $used_indices[] = $pattern_index;
            $result[$pattern_index] = $data[$i];
        }

        $final_result = implode('', array_filter($result, function($char) {
            return $char !== null;
        }));

        return $final_result;
    }

    private function sha256_with_complex_dizziness($input, $key) {
        $hash = hash('sha256', $input);
        $dizziness_value = $this->generate_dizziness_value($key);
        $pattern = substr($dizziness_value, 0, strlen($hash));
        $hash_bin = hex2bin($hash);
        $mixed_hash = $this->bitwise_mix($hash_bin, $pattern);
        $second_pattern = substr($dizziness_value, strlen($hash) % strlen($dizziness_value), strlen($hash));
        $final_hash = $this->bitwise_mix($mixed_hash, $second_pattern);
        return bin2hex($final_hash);
    }

    private function generate_dizziness_value($key) {
        return hash('sha256', $key);
    }

    private function split_into_32_blocks($data) {
        $block_size = 32;
        $blocks = [];
        $data_length = strlen($data);

        for ($i = 0; $i < $data_length; $i += $block_size) {
            $blocks[] = substr($data, $i, $block_size);
        }

        if ($data_length % $block_size != 0) {
            $last_block = substr($data, $i - $block_size);
            $padded_block = str_pad($last_block, $block_size, '0');
            $blocks[count($blocks) - 1] = $padded_block;
        }

        return $blocks;
    }

    private function generate_blocks($input) {
        $blocks = [$this->simple_hash($input)];

        while (count($blocks) < $this->target_blocks) {
            $new_blocks = [];

            foreach ($blocks as $block) {
                $split_blocks = $this->split_into_32_blocks($block);
                foreach ($split_blocks as $sub_block) {
                    for ($repeat_index = 0; $repeat_index < $this->repeats; $repeat_index++) {
                        $sub_block = $this->sha256_with_complex_dizziness($sub_block, $this->dizziness_key);
                    }
                    $new_blocks[] = $sub_block;
                }
            }

            $blocks = $new_blocks;
        }

        $final_blocks = array_slice($blocks, 0, $this->target_blocks);
        $result = implode('', $final_blocks);

        return $this->simple_hash($result);
    }

    //password검증절차
    public static function verify_dizziness_hash($user_password ,$hased) {
        $parts = explode('#', $hased);
        $keys = ['repeats', 'dizziness_key', 'hash', 'target_blocks'];
        $hasehd_exp = array_combine($keys, $parts);
        $verify_hasher = new self($hasehd_exp["dizziness_key"], $hasehd_exp["target_blocks"], $hasehd_exp["repeats"]);
        $hash_to_verify = $verify_hasher->hash($user_password);
        if(trim($hash_to_verify) == trim($hased))
        {
            return true;
        }else{
            return false;
        }
    }
}
?>