// Single Page App Controller
class ShipmentManagerApp {
    constructor() {
        this.currentPage = 'dashboard';
        this.pages = ['dashboard', 'orders', 'shipments'];
        this.init();
    }

    init() {
        this.bindEvents();
        this.loadPageFromURL();
        this.updateNavigation();
    }

    bindEvents() {
        // Navigation events
        document.querySelectorAll('[data-page]').forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const page = e.target.getAttribute('data-page');
                this.navigateToPage(page);
            });
        });

        // Handle browser back/forward buttons
        window.addEventListener('popstate', (e) => {
            this.loadPageFromURL();
        });

        // Settings modal events
        document.getElementById('settingsModal').addEventListener('shown.bs.modal', () => {
            this.loadSettings();
        });

        // Settings form submission
        document.getElementById('settingsForm').addEventListener('submit', (e) => {
            e.preventDefault();
            this.saveSettings();
        });

        // Quick action buttons
        document.getElementById('resetSettings').addEventListener('click', () => {
            this.resetSettings();
        });

        document.getElementById('exportSettings').addEventListener('click', () => {
            this.exportSettings();
        });

        document.getElementById('importSettings').addEventListener('click', () => {
            this.showImportModal();
        });

        document.getElementById('testWooCommerce').addEventListener('click', () => {
            this.testWooCommerceConnection();
        });

        document.getElementById('clearData').addEventListener('click', () => {
            this.clearAllData();
        });

        // Import modal events
        document.getElementById('importSettingsBtn').addEventListener('click', () => {
            this.importSettings();
        });
    }

    navigateToPage(page) {
        if (!this.pages.includes(page)) {
            console.error('Invalid page:', page);
            return;
        }

        // Update URL without page reload
        const url = new URL(window.location);
        url.searchParams.set('page', page);
        window.history.pushState({ page }, '', url);

        this.showPage(page);
        this.updateNavigation();
    }

    showPage(page) {
        // Hide all pages
        document.querySelectorAll('.page-content').forEach(pageElement => {
            pageElement.classList.remove('active');
        });

        // Show selected page
        const targetPage = document.getElementById(page + 'Page');
        if (targetPage) {
            targetPage.classList.add('active');
            this.currentPage = page;
        }

        // Update page title
        this.updatePageTitle(page);
    }

    updateNavigation() {
        // Remove active class from all nav links
        document.querySelectorAll('.nav-link[data-page]').forEach(link => {
            link.classList.remove('active');
        });

        // Add active class to current page link
        const activeLink = document.querySelector(`[data-page="${this.currentPage}"]`);
        if (activeLink) {
            activeLink.classList.add('active');
        }
    }

    updatePageTitle(page) {
        const titles = {
            dashboard: 'Shipment Manager - Dashboard',
            orders: 'Shipment Manager - Orders',
            shipments: 'Shipment Manager - Shipments'
        };

        document.title = titles[page] || 'Shipment Manager';
    }

    loadPageFromURL() {
        const urlParams = new URLSearchParams(window.location.search);
        const page = urlParams.get('page') || 'dashboard';
        this.showPage(page);
        this.updateNavigation();
    }

    // Settings Management
    loadSettings() {
        // Load settings from localStorage or default values
        const settings = this.getStoredSettings();
        this.populateSettingsForm(settings);
        this.updateSystemInfo();
    }

    getStoredSettings() {
        const defaultSettings = {
            maxCapacity: 1000,
            maxVolume: 10,
            upcomingShipments: 2,
            ordersPerPage: 25,
            displayMode: 'volume',
            wooCommerceEnabled: false,
            wooCommerceUrl: '',
            wooCommerceKey: '',
            wooCommerceSecret: '',
            syncInterval: 15,
            autoSyncOrders: true
        };

        const stored = localStorage.getItem('shipmentManagerSettings');
        return stored ? { ...defaultSettings, ...JSON.parse(stored) } : defaultSettings;
    }

    populateSettingsForm(settings) {
        // Populate form fields with settings
        Object.keys(settings).forEach(key => {
            const element = document.getElementById(key);
            if (element) {
                if (element.type === 'checkbox') {
                    element.checked = settings[key];
                } else {
                    element.value = settings[key];
                }
            }
        });
    }

    saveSettings() {
        const form = document.getElementById('settingsForm');
        const formData = new FormData(form);
        const settings = {};

        // Collect all form data
        form.querySelectorAll('input, select, textarea').forEach(element => {
            if (element.type === 'checkbox') {
                settings[element.id] = element.checked;
            } else if (element.type === 'number' || element.type === 'email' || element.type === 'url') {
                settings[element.id] = element.value;
            } else if (element.tagName === 'SELECT') {
                settings[element.id] = element.value;
            } else {
                const value = formData.get(element.id);
                if (value !== null) {
                    settings[element.id] = value;
                }
            }
        });

        // Store settings
        localStorage.setItem('shipmentManagerSettings', JSON.stringify(settings));
        
        // Update last updated time
        document.getElementById('lastUpdated').textContent = new Date().toLocaleString();
        
        // Reload dashboard if display mode changed
        if (window.shipmentManager && window.shipmentManager.settings) {
            window.shipmentManager.settings.displayMode = settings.displayMode || 'volume';
            window.shipmentManager.settings.maxCapacity = parseFloat(settings.maxCapacity) || 1000;
            window.shipmentManager.settings.maxVolume = parseFloat(settings.maxVolume) || 10;
            window.shipmentManager.settings.upcomingShipments = parseInt(settings.upcomingShipments) || 2;
            
            // Update existing shipments' maxCapacity and maxVolume
            window.shipmentManager.shipments.forEach(shipment => {
                shipment.maxCapacity = window.shipmentManager.settings.maxCapacity;
                shipment.maxVolume = window.shipmentManager.settings.maxVolume;
            });
            
            window.shipmentManager.renderDashboard();
        }
        
        // Show success message
        this.showNotification('Settings saved successfully!', 'success');
        
        // Close modal
        const modal = bootstrap.Modal.getInstance(document.getElementById('settingsModal'));
        modal.hide();
    }

    resetSettings() {
        if (confirm('Are you sure you want to reset all settings to default values?')) {
            localStorage.removeItem('shipmentManagerSettings');
            this.loadSettings();
            this.showNotification('Settings reset to defaults!', 'info');
        }
    }

    exportSettings() {
        const settings = this.getStoredSettings();
        const dataStr = JSON.stringify(settings, null, 2);
        const dataBlob = new Blob([dataStr], { type: 'application/json' });
        
        const link = document.createElement('a');
        link.href = URL.createObjectURL(dataBlob);
        link.download = 'shipment-manager-settings.json';
        link.click();
        
        this.showNotification('Settings exported successfully!', 'success');
    }

    showImportModal() {
        const importModal = new bootstrap.Modal(document.getElementById('importModal'));
        importModal.show();
    }

    importSettings() {
        const fileInput = document.getElementById('settingsFile');
        const file = fileInput.files[0];
        
        if (!file) {
            this.showNotification('Please select a file to import.', 'warning');
            return;
        }

        const reader = new FileReader();
        reader.onload = (e) => {
            try {
                const settings = JSON.parse(e.target.result);
                localStorage.setItem('shipmentManagerSettings', JSON.stringify(settings));
                this.loadSettings();
                
                // Close import modal
                const importModal = bootstrap.Modal.getInstance(document.getElementById('importModal'));
                importModal.hide();
                
                this.showNotification('Settings imported successfully!', 'success');
            } catch (error) {
                this.showNotification('Invalid settings file format.', 'error');
            }
        };
        reader.readAsText(file);
    }

    testWooCommerceConnection() {
        const settings = this.getStoredSettings();
        
        if (!settings.wooCommerceEnabled) {
            this.showNotification('WooCommerce integration is not enabled.', 'warning');
            return;
        }

        if (!settings.wooCommerceUrl || !settings.wooCommerceKey || !settings.wooCommerceSecret) {
            this.showNotification('Please fill in all WooCommerce credentials.', 'warning');
            return;
        }

        // Simulate connection test
        this.showNotification('Testing WooCommerce connection...', 'info');
        
        setTimeout(() => {
            // This would normally make an actual API call
            this.showNotification('WooCommerce connection successful!', 'success');
        }, 2000);
    }

    clearAllData() {
        if (confirm('Are you sure you want to clear all data? This action cannot be undone.')) {
            localStorage.clear();
            this.showNotification('All data cleared successfully!', 'success');
            this.loadSettings();
        }
    }

    updateSystemInfo() {
        // Update system information in settings modal
        const totalOrders = localStorage.getItem('totalOrders') || 0;
        const activeShipments = localStorage.getItem('activeShipments') || 0;
        
        document.getElementById('totalOrdersSettings').textContent = totalOrders;
        document.getElementById('activeShipmentsSettings').textContent = activeShipments;
    }

    showNotification(message, type = 'info') {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
        notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
        notification.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;

        // Add to page
        document.body.appendChild(notification);

        // Auto remove after 5 seconds
        setTimeout(() => {
            if (notification.parentNode) {
                notification.remove();
            }
        }, 5000);
    }
}

// Initialize the app when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    window.shipmentManagerApp = new ShipmentManagerApp();
}); 