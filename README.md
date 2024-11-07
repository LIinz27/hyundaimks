# Project Name: **Hyundai Dealer Makassar**

## Description
This website is designed to provide complete information about Hyundai dealerships in Makassar. Built using Laravel and Bootstrap, it aims to offer an interactive and informative experience for users interested in purchasing or learning more about Hyundai cars.

## Key Features
1. **Vehicle Navigation and Categories**: Displays vehicle categories in a card format with a three-column layout.
2. **Promotional Section**: Features a Swiper slider showcasing attractive promotions offered by the dealership.
3. **Consultation Form**: Includes a form with a custom label for selecting a test drive date.
4. **Benefits Section**: Highlights the advantages for Hyundai car buyers with custom icons from Bootstrap.
5. **Unique Header Design**: Uses very bold font styling in the header section, with a pop-up search icon.
6. **Layout Adjustments**: Header text positioned further to the right for better alignment.

## Technologies Used
- **Laravel**: PHP framework for backend development.
- **Bootstrap**: CSS framework for responsive design and UI components.
- **JavaScript**: A separate JavaScript file at `public/js/scripts.js` for additional functionality.
- **Swiper.js**: Used for the promotional slider section.

## Installation and Setup
1. **Clone the Repository**: 
   ```bash
   git clone https://github.com/LIinz27/hyundaimks
   ```
2. **Install Dependencies**:
   ```bash
   cd hyundaimks
   composer install
   npm install
   ```
3. **Environment Setup**: Copy the `.env.example` file to `.env` and adjust database settings.
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
4. **Run the Application**:
   ```bash
   php artisan migrate
   php artisan serve
   ```
   
## Project Structure
- **Header**: Located in `header.blade.php`, contains the main navigation and pop-up search icon.
- **Homepage**: Defined in `home.blade.php`, including the header, main image, promo section, and sections like `card` and `footer`.
- **Benefit Section**: The benefits section is organized in `benefit.blade.php`, listing the advantages for buyers.
- **Additional Scripts**: JavaScript functionalities can be found in `public/js/scripts.js`.

## Additional UI Settings
- **Font**: Uses the Manrope font for navigation text, set to 14px.
- **Icons**: Utilizes Bootstrap icons for promotional elements and consultation button (label changed to "Pricelist" with the icon positioned to the right of the text).

## Contribution
Please submit a pull request if you wish to contribute to this project. Make sure to follow code standards and conventions.

---

Feel free to modify or expand on this as needed.