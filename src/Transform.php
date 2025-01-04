<?php

namespace Elysio\TypedArray;

use Exception;
use ReflectionClass;
use ReflectionException;

require "vendor/autoload.php";

class Transform
{
    /**
     * Transforms an array of associative arrays into an array of class instances.
     *
     * @param array $data The data to be transformed.
     * @param string $class The fully qualified class name of the target class.
     * @return array An array of instances of the specified class.
     * @throws ReflectionException If the class does not exist or is not accessible.
     * @throws Exception If required keys are missing or types do not match.
     */
    public static function toClass(array $data, string $class): array
    {
        $reflection = new ReflectionClass($class);
        $properties = $reflection->getProperties();
        $instances = [];

        foreach ($data as $item) {
            // Create a new instance of the class without invoking the constructor.
            $instance = $reflection->newInstanceWithoutConstructor();

            foreach ($properties as $property) {
                $propName = $property->getName();
                $propType = $property->getType();

                // Ensure the required key exists in the data.
                if (!array_key_exists($propName, $item)) {
                    throw new Exception("The key '{$propName}' is missing in the data.");
                }

                $value = $item[$propName];

                // Assign the value to the property.
                $property->setValue($instance, $value);
            }

            // Add the instance to the resulting array.
            $instances[] = $instance;
        }

        return $instances;
    }
}
