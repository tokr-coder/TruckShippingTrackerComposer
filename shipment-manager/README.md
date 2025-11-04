# Shipment Manager

A modern, responsive web application for managing shipments and orders with drag-and-drop functionality, capacity tracking, and WooCommerce integration.

## Features

### 🚚 Core Functionality
- **Shipment Capacity Management**: Visual capacity bars showing weight and volume usage
- **Drag & Drop Interface**: Intuitive order management with HTML5 drag-and-drop
- **Auto-Assignment**: Smart order assignment to optimal shipments
- **Holding Area**: Temporary storage for unassigned orders
- **Real-time Updates**: Live capacity calculations and status updates

### 📊 Dashboard
- **Overview Cards**: Quick statistics (total orders, active shipments, pending orders, capacity)
- **Shipment Bars**: Visual representation of upcoming shipments with capacity indicators
- **Order Management**: Add, delete, and move orders between shipments
- **Dispatch Functionality**: Mark shipments as dispatched with delivery estimates

### ⚙️ Settings & Configuration
- **Shipment Capacity**: Configurable weight and volume limits
- **Display Options**: Number of upcoming shipments to show
- **Notification Settings**: Email alerts and capacity warnings
- **WooCommerce Integration**: API-based order synchronization
- **Auto-Assignment Rules**: Customizable assignment strategies

### 🔗 WooCommerce Integration
- **API Connection**: Secure REST API integration
- **Order Synchronization**: Automatic order import and status updates
- **Webhook Support**: Real-time order notifications
- **Bidirectional Updates**: Update WooCommerce when shipments are dispatched

## Installation

### Prerequisites
- PHP 7.4 or higher
- Web server (Apache/Nginx)
- Modern web browser with JavaScript enabled

### Quick Start
1. **Download/Clone** the application to your web server directory
2. **Set Permissions** (if needed):
   ```bash
   chmod 755 -R shipment-manager/
   ```
3. **Access the Application**: Open `http://your-domain/shipment-manager/` in your browser

### WooCommerce Setup
1. **Generate API Keys**:
   - Go to WooCommerce → Settings → Advanced → REST API
   - Click "Add Key"
   - Set permissions to "Read/Write"
   - Copy the Consumer Key and Consumer Secret

2. **Configure Integration**:
   - Go to Settings → WooCommerce Integration
   - Enable WooCommerce Integration
   - Enter your store URL and API credentials
   - Test the connection

## Usage

### Adding Orders
1. Click "Add New Order" button on the dashboard
2. Fill in order details (ID, customer info, weight, volume, priority)
3. Orders are automatically assigned to available shipments

### Managing Shipments
- **View Capacity**: Each shipment shows weight and volume usage with color-coded bars
- **Move Orders**: Drag orders between shipments or to the holding area
- **Dispatch**: Click "Dispatch" button to mark shipment as sent
- **Auto-Creation**: New shipments are created automatically when needed

### Settings Configuration
- **General Settings**: Configure capacity limits and display options
- **Notifications**: Set up email alerts and warning thresholds
- **WooCommerce**: Configure API credentials and sync intervals
- **Import/Export**: Backup and restore settings

## File Structure

```
shipment-manager/
├── index.php                 # Main dashboard
├── assets/
│   ├── css/
│   │   └── style.css        # Main stylesheet
│   └── js/
│       ├── dashboard.js     # Dashboard functionality
│       └── settings.js      # Settings page functionality
├── pages/
│   └── settings.php         # Settings page
├── includes/                # PHP includes (future use)
│   ├── api/
│   └── classes/
└── api/                     # API endpoints (future use)
```

## Configuration

### Default Settings
- **Max Capacity**: 1000 kg per shipment
- **Max Volume**: 10 m³ per shipment
- **Upcoming Shipments**: 2 displayed on dashboard
- **Warning Threshold**: 80% capacity
- **Sync Interval**: 15 minutes (WooCommerce)

### Customization
All settings can be modified through the web interface or by editing the JavaScript configuration files.

## Browser Support

- Chrome 80+
- Firefox 75+
- Safari 13+
- Edge 80+

## Development

### Adding New Features
1. **Frontend**: Add JavaScript functionality in `assets/js/`
2. **Styling**: Modify CSS in `assets/css/style.css`
3. **Backend**: Create PHP files in `includes/` and `api/` directories

### Database Integration
The current version uses localStorage for demo purposes. For production use:
1. Set up MySQL/PostgreSQL database
2. Create tables using the schema provided in the documentation
3. Implement PHP API endpoints for data persistence

## API Endpoints (Future Implementation)

### Orders
- `GET /api/orders` - List all orders
- `POST /api/orders` - Create new order
- `PUT /api/orders/{id}` - Update order
- `DELETE /api/orders/{id}` - Delete order

### Shipments
- `GET /api/shipments` - List all shipments
- `POST /api/shipments` - Create new shipment
- `PUT /api/shipments/{id}` - Update shipment
- `POST /api/shipments/{id}/dispatch` - Dispatch shipment

### Settings
- `GET /api/settings` - Get application settings
- `PUT /api/settings` - Update settings

## Security Considerations

- **Input Validation**: All user inputs are validated
- **XSS Protection**: Output encoding implemented
- **CSRF Protection**: Token-based form protection
- **API Security**: JWT authentication for API endpoints

## Troubleshooting

### Common Issues

1. **Drag & Drop Not Working**
   - Ensure JavaScript is enabled
   - Check browser console for errors
   - Verify modern browser compatibility

2. **WooCommerce Connection Fails**
   - Verify API credentials
   - Check store URL format
   - Ensure REST API is enabled in WooCommerce

3. **Settings Not Saving**
   - Check browser localStorage support
   - Verify file permissions
   - Clear browser cache

### Performance Optimization
- Enable browser caching
- Minify CSS/JS files for production
- Use CDN for external libraries
- Implement database indexing

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

## License

This project is licensed under the MIT License - see the LICENSE file for details.

## Support

For support and questions:
- Create an issue on GitHub
- Check the documentation
- Review troubleshooting section

## Roadmap

### Version 1.1
- [ ] Database integration
- [ ] User authentication
- [ ] Advanced reporting
- [ ] Mobile app

### Version 1.2
- [ ] Multi-language support
- [ ] Advanced analytics
- [ ] API documentation
- [ ] Plugin architecture

### Version 2.0
- [ ] Real-time collaboration
- [ ] Advanced automation
- [ ] Integration marketplace
- [ ] Cloud deployment options 