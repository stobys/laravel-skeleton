
// -- Alpine.JS
import Alpine from 'alpinejs'
import users from './alpine/users.js'
import roles from './alpine/roles.js'
import permissions from './alpine/permissions.js'
import sessions from './alpine/sessions.js'

window.Alpine = Alpine

// Alpine.data('alpineData', alpineData)
Alpine.data('alpineUsers', users)
Alpine.data('alpineRoles', roles)
Alpine.data('alpinePermissions', permissions)
Alpine.data('alpineSessions', sessions)

document.addEventListener('DOMContentLoaded', function (event) {
    Alpine.start()
});
