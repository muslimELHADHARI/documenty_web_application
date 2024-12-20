<template>
    <div id="app">
      <h1>Welcome to My Vue App</h1>
      <VideoPlayer></VideoPlayer>
    </div>
  </template>
  
  <script>
  export default {
    name: 'App',
    components: {
      Test,
    },
  };
  </script>
  
  <style>
  #app {
    font-family: Arial, sans-serif;
    text-align: center;
    margin-top: 20px;
  }
  </style>