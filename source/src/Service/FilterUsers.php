<?php

namespace App\Service;

class FilterUsers
{
    public function filterUsersByFirstLetter(array $users, string $letter): array
    {
        return array_filter($users, function ($user) use ($letter) {
            $firstLetter = mb_strtolower(!empty($user['name']) ? $user['name'][0] : '');
            return mb_strtolower($letter) === $firstLetter;
        });
    }

    public function filterUsersByOddId(array $users): array
    {
        return array_filter($users, function ($user) {
            return $user['id'] % 2 === 1;
        });
    }

    public function filterUsersByEvenId(array $users): array
    {
        return array_filter($users, function ($user) {
            return $user['id'] % 2 === 0;
        });
    }
}
