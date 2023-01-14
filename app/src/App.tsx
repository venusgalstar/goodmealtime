import { StyleSheet, View } from 'react-native'
import React from 'react'
import { RootNavigation } from '../src/navigations'

const App = () => {
  return (
    <View style={Styles.container}>
      <RootNavigation />
    </View>
  )
}

export default App

const Styles = StyleSheet.create({
  container: {
    flex: 1
  },
})