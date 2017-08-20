import axios from 'axios';

const HTTP = axios.create({
  baseURL: process.env.API_URL,
});

export default HTTP;
