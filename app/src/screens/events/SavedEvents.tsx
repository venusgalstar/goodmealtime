import { View, Text, StyleSheet } from 'react-native'
import React, { useState } from 'react'
import { eventsData } from '../home/Data'
import Container from '../../components/Container'
import { Header } from '../../components'
import { Colors } from '../../res'
import Ionicons from 'react-native-vector-icons/Ionicons';
import { wp } from '../../global'
import Events from './Events'
import SavedEventsFilter from './SavedEventsFilter'

const SavedEvents = (props: any) => {
    const [events, setEvents] = useState(eventsData)
    const [filterPressed, setFilterPressed] = useState(false)

    const onFilterPress = () => setFilterPressed(true)
    const onCloseFilter = () => setFilterPressed(false)

    return (
        <Container>
            <Header
                centetText="Saved Events"
                navigation={props.navigation}
                Right={() => <Ionicons name='filter'
                    color={Colors.color4} size={wp(6)}
                    style={Styles.headerRight}
                    onPress={onFilterPress}
                />}
            />
            <Events
                data={events}
                navigation={props.navigation}
            />
            <SavedEventsFilter
                visible={filterPressed}
                onClose={onCloseFilter}
            />
        </Container>
    )
}

export default SavedEvents

const Styles = StyleSheet.create({
    headerContainer: {
        backgroundColor: Colors.color2
    },
    shadow: {
        shadowColor: Colors.color1,
        shadowOffset: {
            width: 0,
            height: 5,
        },
        shadowOpacity: 0.1,
        shadowRadius: 3.84,
        elevation: 7,
    },
    headerRight: {
        marginLeft: wp(10)
    }
})