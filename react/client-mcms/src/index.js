import React from 'react';
import ReactDOM from 'react-dom';
import './css/index.css';
import App from './App';
import * as serviceWorker from './serviceWorker';
import { FirebaseAppProvider, useFirestoreDocData, useFirestore, SuspenseWithPerf } from 'reactfire';

const firebaseConfig = {
  apiKey: "AIzaSyAJzkJOcx8xRQ6ub_cQFaVGs2ExJ1iw384",
  authDomain: "mcms-ghost.firebaseapp.com",
  databaseURL: "https://mcms-ghost.firebaseio.com",
  projectId: "mcms-ghost",
  storageBucket: "mcms-ghost.appspot.com",
  messagingSenderId: "459837334102",
  appId: "1:459837334102:web:971b8784ec9abfc91951f7",
  measurementId: "G-3MHY3TC0ES"
}

ReactDOM.render(
  <FirebaseAppProvider firebaseConfig={firebaseConfig}>
    <SuspenseWithPerf fallback={<p>Cargando MCMS...</p>} traceId={'load-mcms-status'}>
      <React.StrictMode>
        <App />
      </React.StrictMode>
      </SuspenseWithPerf>
  </FirebaseAppProvider>,
  document.getElementById('root')
)

// If you want your app to work offline and load faster, you can change
// unregister() to register() below. Note this comes with some pitfalls.
// Learn more about service workers: https://bit.ly/CRA-PWA
serviceWorker.unregister()
