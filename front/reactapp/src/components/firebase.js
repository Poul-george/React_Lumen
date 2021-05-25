import firebase from "firebase/app";
import "firebase/storage";

var firebaseConfig = {
  // ここに自分のプロジェクトのconfigをペースト
  apiKey: "AIzaSyAi3OHM04PGrkiWf78oSQcBwDLZjbALmjI",
  authDomain: "myportfolioproject-c449f.firebaseapp.com",
  databaseURL: "https://myportfolioproject-c449f.firebaseio.com",
  projectId: "myportfolioproject-c449f",
  storageBucket: "myportfolioproject-c449f.appspot.com",
  messagingSenderId: "382914868058",
  appId: "1:382914868058:web:ba0d37e9285d0e499b7963",
  measurementId: "G-2B2G2RS3BT"
};
// Initialize Firebase
firebase.initializeApp(firebaseConfig);

export const storage = firebase.storage();
export default firebase;