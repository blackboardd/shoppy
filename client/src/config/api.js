// api environmental variables
let apiUrl = '';

if (process.env.NODE_ENV === 'production') {
  apiUrl =
    'https://shoppyapi.xyz:8000/api/v1';
} else {
  apiUrl = 'http://localhost:8000/api/v1';
}

export const API_URL = apiUrl;
