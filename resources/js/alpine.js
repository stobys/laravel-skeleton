
// -- Alpine.JS
import Alpine from 'alpinejs'
import users from './alpine/users.js'
import roles from './alpine/roles.js'
import permissions from './alpine/permissions.js'

window.Alpine = Alpine

Alpine.data('alpineUsers', users)
Alpine.data('alpineRoles', roles)
Alpine.data('alpinePermissions', permissions)

document.addEventListener('DOMContentLoaded', function (event) {
    Alpine.start();
});
