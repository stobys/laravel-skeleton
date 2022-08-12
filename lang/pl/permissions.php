<?php

return [
    'controller'    => 'Uprawnienia',
    'model'         => 'Uprawnienie',

        'index-title' => 'Lista Uprawnień',
        'create-title' => 'Tworzenie Uprawnienia',
        'edit-title' => 'Edycja Uprawnienia',
        'show-title' => 'Podgląd Uprawnienia',

        'add-model'     => 'Dodaj Uprawnienie',
        'no-rows-found'     => 'Brak uprawnień spełniających zadane kryterium',

        'title'          => 'Uprawnienia',
        'title_plural'   => 'Uprawnienia',
        'title_singular' => 'Uprawnienie',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Nazwa',
            'name_helper'       => '',
            'description'       => 'Opis',
            'description_helper'=> '',
            'group_id'          => 'Grupa',
            'group_id_helper'   => '',
            'group'             => 'Grupa',
            'group_helper'      => '',
            'groups'            => 'Grupy',
            'groups_helper'     => '',
            'created_at'        => 'Uworzono',
            'created_at_helper' => '',
            'updated_at'        => 'Edytowano',
            'updated_at_helper' => '',
            'deleted_at'        => 'Usunięto',
            'deleted_at_helper' => '',
        ],

        'descriptions'  => [
            'permissions'  => [
                'access'   => 'lista uprawnień',
                'index'    => 'lista uprawnień',
                'trash'    => 'lista usuniętych uprawnień',
                'create'   => 'tworzenie uprawnień',
                'edit'     => 'edycja uprawnień',
                'show'     => 'podgląd uprawnień',
                'delete'   => 'usuwanie uprawnień',
                'restore'  => 'przywracania uprawnień',
            ],
            'roles'        => [
                'access'   => 'lista ról użytkownika',
                'index'    => 'lista ról użytkownika',
                'trash'    => 'lista usuniętych ról użytkownika',
                'create'   => 'tworzenie ról użytkownika',
                'edit'     => 'edycja ról użytkownika',
                'show'     => 'podgląd ról użytkownika',
                'delete'   => 'usuwanie ról użytkownika',
                'restore'  => 'przywracania ról użytkownika',
            ],
            'users'        => [
                'access'   => 'lista użytkowników',
                'index'    => 'lista użytkowników',
                'trash'    => 'lista usuniętych użytkowników',
                'create'   => 'tworzenie użytkowników',
                'edit'     => 'edycja użytkowników',
                'show'     => 'podgląd użytkowników',
                'delete'   => 'usuwanie użytkowników',
                'restore'  => 'przywracania użytkowników',
            ],
        ],

        'tabs'  => [
            'active'    => 'Aktywne',
            'trashed'   => 'Usunięte',
        ],

        'groups'    => [
            'descriptions'  => [
                'permissions'   => 'Uprawnienia',
                'roles'         => 'Role Użytkowników',
                'users'         => 'Użytkownicy',
            ],
        ],

    'messages'  => [
        'update-successful'    => 'Pomyślnie zedytowano uprawnienie ":name".',
        'update-unsuccessful'    => 'Nie udało się zedytować uprawnienia ":name"!',
        'delete-successful'    => 'Pomyślnie usunięto uprawnienie ":name".',
        'delete-unsuccessful'    => 'Nie udało się usunąć uprawnienia ":name"!',
        'restore-successful'    => 'Pomyślnie przywrócono uprawnienie ":name".',
        'restore-unsuccessful'    => 'Nie udało się przywrócić uprawnienia ":name"!',

        'confirm-delete'            => 'Czy na pewno chcesz usunąć to uprawnienie?',
        'confirm-delete-approve'    => 'TAK, usuń!',
        'confirm-delete-deny'       => 'NIE, nie usuwaj!',

        'confirm-restore'            => 'Czy na pewno chcesz przywrócić to uprawnienie?',
        'confirm-restore-approve'    => 'TAK, przywróć!',
        'confirm-restore-deny'       => 'NIE, nie przywracaj!',


        'confirm-delete-selected'           => 'Czy na pewno usunąć zaznaczone uprawnienia?',
        'confirm-delete-selected-approve'   => 'TAK, usuń!',
        'confirm-delete-selected-deny'      => 'NIE, nie usuwaj!',

        'confirm-restore-selected'           => 'Czy na pewno przywrócić zaznaczone uprawnienia?',
        'confirm-restore-selected-approve'   => 'TAK, przywróć!',
        'confirm-restore-selected-deny'      => 'NIE, nie przywracaj!',
    ],
];
