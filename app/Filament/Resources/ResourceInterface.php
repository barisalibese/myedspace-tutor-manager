<?php

namespace App\Filament\Resources;

interface ResourceInterface
{
    public static function getInputComponents(): array;

    public static function getViewColumns(): array;
}
