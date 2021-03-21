import React from 'react';
import DrawerNavigation from './components/Navigators/DrawerNavigation';
import BottomTabNavigation from './components/Navigators/BottonTabNavigation'
import StackNavigation from './components/Navigators/StackNavigation';
import '@react-native-firebase/app'

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

export default function App() {
  return (
    <StackNavigation />
  );
}
