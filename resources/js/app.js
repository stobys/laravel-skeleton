import './bootstrap';

import '/node_modules/admin-lte/dist/js/adminlte.min.js';
import '/node_modules/moment/min/moment-with-locales.min.js';

import '/node_modules/select2/dist/js/select2.min.js';
// import '/node_modules/select2/dist/js/i18n/en.js';
// import '/node_modules/select2/dist/js/i18n/pl.js';

import './alpine.js';

// import '/node_modules/chart.js/dist/chart.min.js';
// import '/node_modules/chartjs-plugin-datalabels/dist/chartjs-plugin-datalabels.min.js';

// impoort '/resources/repos/boostrap-datepicker/dist/js/bootstrap-datepicker.min.js';

// import '/resources/js/prototypes.js';
import '/resources/js/onload.js';
import '/resources/js/scripts.js';
// import '/resources/js/vAPP.js';
// impoort '/resources/js/vue.js',

// -- my own vAPP
import vAPP from './vAPP.js';
window.vAPP = new vAPP;

import '/resources/js/jquery.js';

// import '/resources/js/charts-utils.js';
// import '/resources/js/charts.js';

