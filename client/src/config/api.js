// api environmental variables
let apiUrl = '';

if (process.env.NODE_ENV === 'production') {
  apiUrl = 'https://brightentompkinsjuniordevelopertesttask.000webhostapp.com:8000/api/v1';
} else {
  apiUrl = 'http://localhost:8000/api/v1';
}

export const API_URL = apiUrl;
