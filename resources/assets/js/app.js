import React from 'react';
import ReactDOM from 'react-dom';
import Layout from './components/layout';

import {StyleRoot} from 'radium';

const app = document.getElementById('app');

ReactDOM.render(<StyleRoot><Layout/></StyleRoot>, app);
