<?php
/**
 * Created by PhpStorm.
 * User: chonsyu
 * Date: 05.08.2018
 * Time: 12:51
 */

namespace Discord;


interface ValueObjectInterface extends \JsonSerializable
{
    /**
     * @return ValueObjectInterface
     */
    public static function fromNative($value): ValueObjectInterface;

    /**
     * @param  ValueObjectInterface $object
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $object): bool;

    /**
     * @return string
     */
    public function __toString(): string;

    /**
     * @param $value
     * @return mixed
     */
    public static function guard($value): bool;
}