<?php

return [
        'controller'    => 'Użytkownicy',
        'model'         => 'Użytkownik',

        'index-title' => 'Lista Użytkowników',
        'create-title' => 'Tworzenie Użytkownika',
        'edit-title' => 'Edycja Użytkownika',
        'show-title' => 'Podgląd Użytkownika',
        'trash-title' => 'Użytkownicy Usunięci',

        'add-model'      => 'Dodaj Użytkownika',
        'no-rows-found'     => 'Brak użytkowników spełniających zadane kryterium',

        'title'          => 'Użytkownicy',
        'title_plural'  => 'Użytkownicy',
        'title_singular' => 'Użytkownik',
        'profile'          => 'Profil',

        'any'       => 'Dowolny Użytkownik',
        
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => '',
            'name'                     => 'Nazwa',
            'name_placeholder'         => 'Username, Imię lub Nazwisko',
            'name_helper'              => '',
            'username'                 => 'Nazwa Użytkownika',
            'username_placeholder'     => 'Nazwa Użytkownika',
            'username_helper'          => '',
            'personal_no'              => 'Nr Personalny',
            'personal_no_placeholder'  => 'Nr Personalny',
            'personal_no_helper'       => '',
            'family_name'              => 'Nazwisko',
            'family_name_helper'       => '',
            'family_name_placeholder'  => 'Nazwisko',
            'given_name'               => 'Imię',
            'given_name_helper'        => '',
            'given_name_placeholder'   => 'Imię',
            'email'                    => 'Email',
            'email_helper'             => '',
            'email_placeholder'        => 'Email',
            'email_verified_at'        => 'Weryfikacja Email',
            'email_verified_at_helper' => '',
            'password'                 => 'Hasło',
            'password_helper'          => '',
            'password_confirm'         => 'Potwierdzenie Hasła',
            'password_confirm_helper'  => '',
            'roles'                    => 'Role',
            'roles_helper'             => '',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => '',
            'created_at'               => 'Utworzono',
            'created_at_helper'        => '',
            'updated_at'               => 'Edytowano',
            'updated_at_helper'        => '',
            'deleted_at'               => 'Usunięto',
            'deleted_at_helper'        => '',
        ],

        'actions'   => [
            'profile'   => 'Profil',
            'settings'  => 'Ustawienia',
            'print-badge'   => 'Wydrukuj Kartę Logowania',
            'show-versions' => 'Pokaż historię zmian',
        ],

        'tabs'   => [
            'active'   => 'Aktywni',
            'trashed'  => 'Usunięci',
        ],

        'messages'  => [
            'update-successful'    => 'Pomyślnie zedytowano użytkownika ":username".',
            'update-unsuccessful'    => 'Nie udało się zedytować użytkownika ":username"!',
            'delete-successful'    => 'Pomyślnie usunięto użytkownika ":username".',
            'delete-unsuccessful'    => 'Nie udało się usunąć użytkownika ":username"!',
            'restore-successful'    => 'Pomyślnie przywrócono użytkownika ":username".',
            'restore-unsuccessful'    => 'Nie udało się przywrócić użytkownika ":username"!',

            'confirm-delete'            => 'Czy na pewno chcesz usunąć tego użytkownika?',
            'confirm-delete-approve'    => 'TAK, usuń!',
            'confirm-delete-deny'       => 'NIE, nie usuwaj!',

            'confirm-restore'            => 'Czy na pewno chcesz przywrócić tego użytkownika?',
            'confirm-restore-approve'    => 'TAK, przywróć!',
            'confirm-restore-deny'       => 'NIE, nie przywracaj!',


            'confirm-delete-selected'           => 'Czy na pewno usunąć zaznaczonych użytkowników?',
            'confirm-delete-selected-approve'   => 'TAK, usuń!',
            'confirm-delete-selected-deny'      => 'NIE, nie usuwaj!',

            'confirm-restore-selected'           => 'Czy na pewno przywrócić zaznaczonych użytkowników?',
            'confirm-restore-selected-approve'   => 'TAK, przywróć!',
            'confirm-restore-selected-deny'      => 'NIE, nie przywracaj!',
        ],
];
