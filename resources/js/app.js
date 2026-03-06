import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

document.addEventListener('alpine:init', () => {
    Alpine.store('sidebar', {
        isExpanded: true,
        isHovered: false,
        isMobileOpen: false,

        setHovered(value) { this.isHovered = value },
        setMobileOpen(value) { this.isMobileOpen = value },
        toggle() { this.isExpanded = !this.isExpanded }
    })
})

Alpine.start();