import React from 'react';
import ReactDOM from 'react-dom';
import SanityStudio from './app/SanityStudio';

const props = window.SanityConfig; // Assuming you've made LaravelData available globally

ReactDOM.render(
  <SanityStudio {...props} />,
  document.getElementById('sanity-app')
);