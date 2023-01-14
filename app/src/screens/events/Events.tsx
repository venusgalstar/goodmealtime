import { View, StyleSheet, FlatList } from 'react-native'
import React from 'react'
import { wp } from '../../global'
import EventCard from './EventCard'

const Events = (props: any) => {
    const {
        data = [],
        navigation = {}
    } = props

    const onEventPress = () => {
        navigation.navigate('EventDetails')
    }

    const renderList = ({ item }: any) => {
        return (
            <EventCard
                onPress={onEventPress}
                item={item}
            />
        )
    }
    return (
        <View style={Styles.container}>
            <FlatList
                data={data}
                renderItem={renderList}
                showsVerticalScrollIndicator={false}
                contentContainerStyle={Styles.listContainer}
            />
        </View>
    )
}

export default Events



const Styles = StyleSheet.create({
    container: {
        flex: 1,
    },
    listContainer: {
        paddingHorizontal: wp(4),
    },

})