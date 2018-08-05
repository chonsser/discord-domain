<?php
/**
 * Created by PhpStorm.
 * User: chonsyu
 * Date: 05.08.2018
 * Time: 12:50
 */

namespace Discord\ValueObject;
use Discord\Exception\InvalidGuildNameException;
use Discord\ValueObjectInterface;

/**
 * Class GuildName
 * @package Discord\Model
 * @author chonsyu <toja@wtf.city>
 */
final class GuildName implements ValueObjectInterface
{
    const
        MIN_LENGTH = 2,
        MAX_LENGTH = 100;

    /**
     * @var string
     */
    private $value;

    /**
     * GuildName constructor.
     * @param $value
     * @throws InvalidGuildNameException
     */
    public function __construct($value)
    {
        self::guard($value);
        $this->value = $value;
    }

    /**
     * @param $value
     * @return ValueObjectInterface
     * @throws InvalidGuildNameException
     */
    public static function fromNative($value): ValueObjectInterface
    {
        return new self($value);
    }

    /**
     * @param ValueObjectInterface $object
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $object): bool
    {
        /**
         * @var GuildName $object
         */
        return $object->value === (string)$object;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    /**
     * @param $value
     * @return bool
     * @throws InvalidGuildNameException
     */
    public static function guard($value): bool
    {
        if(is_string($value) === false){
            throw new InvalidGuildNameException(
                'Invalid guild name given. Guild name has to be a string'
            );
        }

        $length = mb_strlen($value);

        if ($length > self::MAX_LENGTH) {
            throw new InvalidGuildNameException("Guild name must have less than 100 characters, has " . $length);
        }
        if ($length < self::MIN_LENGTH) {
            throw new InvalidGuildNameException("Guild name must have more than 2 characters, has " . $length);
        }
    }

    /**
     * @return string
     */
    public function jsonSerialize()
    {
        return json_encode($this->value);
    }
}