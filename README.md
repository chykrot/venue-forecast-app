## Weather Forecast and Venue Locator for Cities of Japan

This App provides Travel Data for the Tourists travelling within the City of Japan

- Display Information Different Venues within the City.
- Information Inlcuding Complete Address, Venue Category and Coordinates.
- Exact Location of the Venue presented and marked in Google Map.
- Can present more Venues by clicking Load More.
- Clicking the Venue name will display a Modal for Venue details data.
- Venue details include image of the Venue and description.
- Also helpful tips from fellow tourists and operating hours of the venue.
- Support English and Japanese Language.
- Weather Forecast in the City for 5 days.
- Forecast also includes data for Wind, Humidity anf Visibility.
- Mobile Responsive Design and layout


## How to Use/Install


git clone the repository

composer install

npm install

.env also included with the repository please use it API Keys are stored in the file

npm run dev || npm run watch


## Note:


API for Venue details has a daily limit, if occur it has a error message

If Details are not shown in modal details, it means it has no data from API response

## UI and UX implementation


I choose to design with this Layout with Simplicity, Clean and Resposivenes in mind. For the tourist to easily get and we can present the information that they needed.


## Code implementation


I handle the Third Party API request with the backend using Laravel. To make our app more secure and don't expose our API Keys, additionally we can process those API in our backend before we return it in our frontend.

## SQL Query Exam


The Query for SQL Exam inlcuded with this repository. Please check the filename kris_sql_exam.txt

## Framework and Library


- **[Laravel](https://laravel.com/)**
- **[Vue](https://vuejs.org/)**
- **[Tailwind Css](https://tailwindcss.com/)**

## Third Party API

- **[Open Weather Map](https://openweathermap.org/)**
- **[Foursqure Venue Search](https://foursquare.com/)**
