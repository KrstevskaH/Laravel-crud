import './bootstrap';
import axios from 'axios';
import jQuery from 'jquery';

// Make Axios globally accessible
window.axios = axios;

// Set default headers
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Make jQuery globally accessible
window.$ = jQuery;