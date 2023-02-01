import { StyleSheet, View } from 'react-native'
import React, { createContext, useState } from 'react'
import { RootNavigation } from '../src/navigations'

export const AppStateContext = createContext({});

const App = () => {
  const setGeoData = (_geoData: any) => {
    setGeo(_geoData)
  }

  const [geo, setGeo] = useState({
    geoData: { latitude: 0, longitude: 0 },
    setGeoData
  })

  return (
    <AppStateContext.Provider value={geo}>
      <View style={Styles.container}>
        <RootNavigation />
      </View>
    </AppStateContext.Provider>
  )
}

export default App

const Styles = StyleSheet.create({
  container: {
    flex: 1
  },
})