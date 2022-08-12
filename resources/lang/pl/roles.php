<?php

return [
    'controller'    => 'Role',
    'model'         => 'Rola',

    'index-title' => 'Lista Ról',
    'create-title' => 'Tworzenie Roli',
    'edit-title' => 'Educja Roli',
    'show-title' => 'Podgląd Roli',

    'add-model'     => 'Dodaj Rolę',
    'no-rows-found'     => 'Brak ról spełniających zadane kryterium',

    'title'          => 'Role',
    'title_plural'   => 'Role',
    'title_singular' => 'Rola',
    'fields'         => [
        'id'                 => 'ID',
        'id_helper'          => '',
        'name'              => 'Nazwa',
        'name_helper'       => '',
        'permissions'        => 'Uprawnienia',
        'permissions_helper' => '',
        'created_at'         => 'Utworzono',
        'created_at_helper'  => '',
        'updated_at'         => 'Edytowano',
        'updated_at_helper'  => '',
        'deleted_at'         => 'Usunięto',
        'deleted_at_helper'  => '',
    ],

    'tabs'  => [
        'active'    => 'Aktywne',
        'trashed'   => 'Usunięte',
    ],

    'messages'  => [
        'update-successful'    => 'Pomyślnie zedytowano role ":name".',
        'update-unsuccessful'    => 'Nie udało się zedytować roli ":name"!',
        'delete-successful'    => 'Pomyślnie usunięto role ":name".',
        'delete-unsuccessful'    => 'Nie udało się usunąć roli ":name"!',
        'restore-successful'    => 'Pomyślnie przywrócono role ":name".',
        'restore-unsuccessful'    => 'Nie udało się przywrócić roli ":name"!',

        'confirm-delete'            => 'Czy na pewno chcesz usunąć tę rolę?',
        'confirm-delete-approve'    => 'TAK, usuń!',
        'confirm-delete-deny'       => 'NIE, nie usuwaj!',

        'confirm-restore'            => 'Czy na pewno chcesz przywrócić tę rolę?',
        'confirm-restore-approve'    => 'TAK, przywróć!',
        'confirm-restore-deny'       => 'NIE, nie przywracaj!',


        'confirm-delete-selected'           => 'Czy na pewno usunąć zaznaczone role?',
        'confirm-delete-selected-approve'   => 'TAK, usuń!',
        'confirm-delete-selected-deny'      => 'NIE, nie usuwaj!',

        'confirm-restore-selected'           => 'Czy na pewno przywrócić zaznaczone role?',
        'confirm-restore-selected-approve'   => 'TAK, przywróć!',
        'confirm-restore-selected-deny'      => 'NIE, nie przywracaj!',
    ],
];
