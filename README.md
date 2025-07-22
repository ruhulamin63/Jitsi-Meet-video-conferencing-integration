# Laravel Jitsi Integration

A Laravel application demonstrating Jitsi Meet video conferencing integration using the `amyisme13/laravel-jitsi` package.

## Features

- **JWT Authentication**: Secure room access with JWT tokens
- **User Integration**: Seamless integration with Laravel's User model
- **Customizable UI**: Full control over the video conferencing interface
- **Room Management**: Dynamic room creation and access
- **Laravel 7+ Compatible**: Built for modern Laravel applications

## Requirements

- PHP 7.2.5 or higher
- Laravel 7.x or higher
- Composer
- A Jitsi Meet server (self-hosted or Jitsi Meet server with JWT authentication enabled)

## Installation

### 1. Clone the Repository

```bash
git clone https://github.com/ruhulamin63/jitst-test.git
cd jitst-test
```

### 2. Install Dependencies

```bash
composer install
npm install
```

### 3. Environment Configuration

Copy the environment file and configure your settings:

```bash
cp .env.example .env
```

Add the following Jitsi configuration to your `.env` file:

```env
JITSI_APP_DOMAIN=your-jitsi-domain.com
JITSI_APP_ID=your-app-id
JITSI_APP_SECRET=your-jwt-secret
```

**Environment Variables Explained:**
- `JITSI_APP_DOMAIN`: Your Jitsi Meet server domain (e.g., `meet.jit.si` or your self-hosted domain)
- `JITSI_APP_ID`: Application ID configured in your Jitsi server
- `JITSI_APP_SECRET`: JWT secret key for token generation

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Database Setup

Configure your database in `.env` and run migrations:

```bash
php artisan migrate
```

### 6. Publish Package Assets (Optional)

If you want to customize the views or configuration:

```bash
# Publish configuration
php artisan vendor:publish --tag=config --provider="App\Http\Controllers\Amyisme13\LaravelJitsi\LaravelJitsiServiceProvider"

# Publish views
php artisan vendor:publish --tag=views --provider="App\Http\Controllers\Amyisme13\LaravelJitsi\LaravelJitsiServiceProvider"
```

## Usage

### Basic Room Access

Visit any room by navigating to:
```
http://your-app.com/jitsi/{room-name}
```

For example:
- `http://localhost:8000/jitsi/meeting-room`
- `http://localhost:8000/jitsi/team-standup`

### User Integration

The application uses the `HasJitsiAttributes` trait to integrate with your User model. Make sure your User model includes:

```php
use App\Traits\HasJitsiAttributes;

class User extends Authenticatable
{
    use HasJitsiAttributes;
    
    // Your existing user model code...
}
```

The trait provides the following methods:
- `getJitsiName()`: Returns the user's display name
- `getJitsiEmail()`: Returns the user's email
- `getJitsiAvatar()`: Returns the user's avatar URL

### Routes

The application includes the following routes:

- `GET /`: Welcome page
- `GET /jitsi/{room}`: Join a Jitsi room
- Jitsi package routes (registered via `Route::jitsi()`)

## Configuration

### Jitsi Server Setup

For self-hosted Jitsi Meet servers, you need to:

1. **Enable JWT Authentication** in your Jitsi configuration
2. **Configure the same App ID and Secret** in both Jitsi server and Laravel application
3. **Set up proper CORS headers** if hosting on different domains

### Laravel Configuration

The package configuration is stored in `config/config.php`:

```php
return [
    'domain' => env('JITSI_APP_DOMAIN'),
    'id' => env('JITSI_APP_ID'),
    'secret' => env('JITSI_APP_SECRET'),
];
```

## Development

### Running the Application

```bash
# Start the Laravel development server
php artisan serve

# Compile frontend assets (if needed)
npm run dev

# For development with auto-reloading
npm run watch
```

### Testing

Run the test suite:

```bash
# Run all tests
php artisan test

# Run specific test files
php artisan test tests/Feature/ExampleTest.php
```

## Security Considerations

1. **JWT Secret**: Keep your `JITSI_APP_SECRET` secure and never expose it in client-side code
2. **Domain Validation**: Ensure your Jitsi domain is properly configured to prevent unauthorized access
3. **User Authentication**: Implement proper user authentication before allowing room access
4. **Room Permissions**: Consider implementing room-specific permissions if needed

## Customization

### Custom Views

The room view is located at `resources/views/room.blade.php`. You can customize:
- Jitsi interface styling
- Additional UI elements
- Integration with your application's layout

### User Attributes

Customize how user information is passed to Jitsi by modifying the `HasJitsiAttributes` trait methods:

```php
public function getJitsiName()
{
    return $this->first_name . ' ' . $this->last_name;
}

public function getJitsiAvatar()
{
    return $this->profile_photo_url ?? '/default-avatar.png';
}
```

## Troubleshooting

### Common Issues

1. **"Invalid JWT token"**: Check your `JITSI_APP_SECRET` and `JITSI_APP_ID` configuration
2. **"Domain not allowed"**: Verify your `JITSI_APP_DOMAIN` matches your Jitsi server configuration
3. **CORS errors**: Ensure proper CORS configuration if Jitsi server and Laravel app are on different domains

### Debugging

Enable Laravel debugging to see detailed error messages:

```env
APP_DEBUG=true
LOG_LEVEL=debug
```

Check Laravel logs for detailed error information:

```bash
tail -f storage/logs/laravel.log
```

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests if applicable
5. Submit a pull request

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Support

For issues related to:
- **Laravel Jitsi Package**: Check the [amyisme13/laravel-jitsi](https://github.com/amyisme13/laravel-jitsi) repository
- **Jitsi Meet**: Visit the [Jitsi Meet documentation](https://jitsi.github.io/handbook/)
- **This Implementation**: Open an issue in this repository