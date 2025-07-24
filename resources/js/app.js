
import "./bootstrap";
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import { initNavigation } from './components/navigation.js';
import { initHomepage } from './components/homepage.js';
import { initProfile } from './components/profile.js';
import { initEducationModal } from './components/education.js';

// Initialize components
initNavigation();
initHomepage();
initProfile();
initEducationModal();

