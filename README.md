# MXOptra - Fleet Management & Delivery Optimization API

A Laravel-based REST API for managing fleet operations, delivery optimization, and logistics. This system provides comprehensive endpoints for managing orders, drivers, vehicles, runs, PODs (Proof of Delivery), and distribution centers.

## Features

### Order Management
- Create, read, update, and delete orders
- Track order execution details
- Manage order items
- Handle POD (Proof of Delivery) information
- Real-time widget information
- Order tracking and status updates

### Driver Management
- Full CRUD operations for drivers
- Driver scheduling and availability
- Territory-based driver assignment
- Driver status tracking
- Schedule management
- Partial updates support

### Vehicle Management
- Complete vehicle fleet management
- Vehicle scheduling and tracking
- Capacity and specification tracking
- Maintenance scheduling
- Feature tracking (GPS, refrigeration, etc.)
- Vehicle status monitoring

### Run Management
- Create and manage delivery runs
- Order assignment to runs
- Run scheduling
- Break time management
- Run optimization

### POD (Proof of Delivery) System
- Digital signature capture
- Photo upload and management
- POD notes and history
- Status tracking
- Multi-photo support
- Comprehensive POD history

### Distribution Center Management
- Distribution center operations
- Capacity tracking
- Workload monitoring
- Schedule management
- Feature tracking (cold storage, hazmat, etc.)
- Operating hours management

## Technical Stack

- PHP 8.1+
- Laravel 10.x
- MySQL/PostgreSQL
- Laravel Sanctum for API authentication
- Redis for caching (optional)

## Installation

1. Clone the repository:
```bash
git clone https://github.com/iamsaqibs/mxoptra.git
cd mxoptra
```

2. Install dependencies:
```bash
composer install
```

3. Copy environment file:
```bash
cp .env.example .env
```

4. Configure your environment variables in `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

5. Generate application key:
```bash
php artisan key:generate
```

6. Run migrations:
```bash
php artisan migrate
```

7. (Optional) Seed the database:
```bash
php artisan db:seed
```

## API Documentation

### Base URL
```
/api/v1
```

### Available Endpoints

#### Orders
- `GET /orders` - List all orders
- `POST /orders` - Create a new order
- `GET /orders/{id}` - Get order details
- `PUT /orders/{id}` - Update an order
- `DELETE /orders/{id}` - Delete an order
- `GET /orders/{id}/execution` - Get execution details
- `GET /orders/{id}/items` - Get order items
- `GET /orders/{id}/pod` - Get POD details
- `GET /orders/{id}/widget` - Get widget info

#### Drivers
- `GET /drivers` - List all drivers
- `POST /drivers` - Create a new driver
- `GET /drivers/{id}` - Get driver details
- `PUT /drivers/{id}` - Update a driver
- `PATCH /drivers/{id}` - Partial update
- `DELETE /drivers/{id}` - Delete a driver
- `GET /drivers/{id}/schedule` - Get driver schedule

#### Vehicles
- `GET /vehicles` - List all vehicles
- `POST /vehicles` - Create a new vehicle
- `GET /vehicles/{id}` - Get vehicle details
- `PUT /vehicles/{id}` - Update a vehicle
- `PATCH /vehicles/{id}` - Partial update
- `DELETE /vehicles/{id}` - Delete a vehicle
- `GET /vehicles/{id}/schedule` - Get vehicle schedule

#### Runs
- `GET /runs` - List all runs
- `POST /runs` - Create a new run
- `GET /runs/{id}` - Get run details
- `PUT /runs/{id}` - Update a run
- `DELETE /runs/{id}` - Delete a run
- `GET /runs/{id}/schedule` - Get run schedule
- `GET /runs/{id}/orders` - Get run orders
- `POST /runs/{id}/orders/{orderId}` - Add order to run
- `DELETE /runs/{id}/orders/{orderId}` - Remove order from run

#### PODs
- `GET /pods/orders/{orderId}` - Get POD details
- `POST /pods/orders/{orderId}` - Create POD
- `PUT /pods/orders/{orderId}` - Update POD
- `POST /pods/orders/{orderId}/photos` - Upload POD photo
- `DELETE /pods/orders/{orderId}/photos/{photoId}` - Delete POD photo
- `POST /pods/orders/{orderId}/notes` - Add POD note
- `GET /pods/orders/{orderId}/history` - Get POD history

#### Distribution Centers
- `GET /distribution-centers` - List all centers
- `POST /distribution-centers` - Create a new center
- `GET /distribution-centers/{id}` - Get center details
- `PUT /distribution-centers/{id}` - Update a center
- `DELETE /distribution-centers/{id}` - Delete a center
- `GET /distribution-centers/{id}/schedule` - Get center schedule
- `GET /distribution-centers/{id}/capacity` - Get center capacity
- `GET /distribution-centers/{id}/workload` - Get center workload

## Testing

Run the test suite:
```bash
php artisan test
```

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details.

## Support

For support, open an issue in the GitHub repository.

## Authors

- Muhammad Saqib Saeed - [iamsaqibs](https://github.com/iamsaqibs)

## Acknowledgments

- Laravel Team for the amazing framework
- All contributors who participate in this project
