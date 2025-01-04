# TypedArray

A PHP package for transforming associative arrays into typed objects, simulating TypeScript interfaces for better type safety in PHP projects.

## Features

- Convert arrays to objects based on class definitions.
- Ensure type validation for properties.
- Enhance code readability and maintainability with type safety.
- Works seamlessly with any PHP project, including Laravel.

---

## Installation

Install the package via Composer:

```SH
composer require elysio/typed-array
```

---

## Basic Usage

### Example 1: Simple Array to Class Transformation

Define a class with typed properties:

```PHP
namespace App\Models;

class User {
public string $name;
public int $age;
}
```

Transform an array into typed objects:

```PHP
use Elysio\TypedArray\Transform;
use App\Models\User;

$data = [
['name' => 'Alice', 'age' => 28],
['name' => 'Bob', 'age' => 35]
];

$users = Transform::toClass($data, User::class);

foreach ($users as $user) {
echo "{$user->name} is {$user->age} years old.\n";
}
```

**Output: Alice is 28 years old. Bob is 35 years old.**


---

### Example 2: Type Validation

If the input data has missing keys or invalid types, an exception will be thrown:

```PHP
$data = [
['name' => 'Charlie'], // Missing 'age'
['name' => 'Diana', 'age' => 'thirty'] // Invalid type for 'age'
];

try {
$users = Transform::toClass($data, User::class);
} catch (Exception $e) {
echo "Error: " . $e->getMessage();
}
```

**Output: Error: The key 'age' is missing in the data.**


---

### Example 3: Nested Objects

You can use the package for nested structures by defining relationships between classes:

```PHP
namespace App\Models;

class Address {
public string $city;
public string $zipcode;
}

class User {
public string $name;
public Address $address;
}
```

Transform data with nested structures:

```PHP
use Elysio\TypedArray\Transform;
use App\Models\User;
use App\Models\Address;

$data = [
[
'name' => 'Eve',
'address' => ['city' => 'Paris', 'zipcode' => '75000']
]
];

$users = Transform::toClass($data, User::class);

foreach ($users as $user) {
echo "{$user->name} lives in {$user->address->city} ({$user->address->zipcode}).\n";
}
```

**Output: Eve lives in Paris (75000).**


---

## Error Handling

### Common Exceptions

- **Missing Key Exception**: Thrown when a required key is missing in the input data.
- **Type Mismatch Exception**: Thrown when a property's type does not match the expected type.

---

## License

This package is open-sourced software licensed under the [MIT License](LICENSE).



MIT License

Copyright (c) 2025 Elysio Martins

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
```
