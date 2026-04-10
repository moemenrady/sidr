<?php
use App\Models\Color;
use Spatie\Color\Hex;
use Spatie\Color\Lab;

function hexToLab(string $hex): array {
    // returns [L, a, b]
    $color = Hex::fromString($hex)->toLab();
    // $color is instance of Lab
    return [
        'L' => $color->getL(),
        'a' => $color->getA(),
        'b' => $color->getB(),
    ];
}

// Example: when creating color
$hex = '#ff6600';
[$L, $a, $b] = array_values(hexToLab($hex));
Color::create([
    'name' => 'My color',
    'hex' => $hex,
    'lab_l' => $L,
    'lab_a' => $a,
    'lab_b' => $b,
]);
