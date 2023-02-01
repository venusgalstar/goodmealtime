import { View, StyleSheet, FlatList } from 'react-native'
import React, { useState, useEffect } from 'react'
import AsyncStorage from '@react-native-async-storage/async-storage'
import { wp } from '../../global'
import EventCard from './EventCard'
import { SAVE_EVENT, FAST_REFETCH, REFETCH, API_PATH } from '../../config'

const Events = (props: any) => {
    const {
        navigation = {}
    } = props

    const [savedEvents, setSavedEvents] = useState([])
    const [fastRefetch, setFastRefetch] = useState(true)
    const [refetch, setRefetch] = useState(true)
    const [events, setEvents] = useState([])

    useEffect(() => {
        // console.log("[===Events data===]", data)
        const timerID = setInterval(() => {
            setRefetch((prevRefetch) => {
                return !prevRefetch;
            });
        }, REFETCH);

        const fastTimerID = setInterval(() => {
            setFastRefetch((prevRefetch) => {
                return !prevRefetch;
            });
        }, FAST_REFETCH);

        return () => {
            clearInterval(timerID);
            clearInterval(fastTimerID);
        };
    }, []);

    useEffect(() => {
        const fetchAsyncStorage = async () => {
            try {
                const getSavedData = await AsyncStorage.getItem(SAVE_EVENT);
                if (getSavedData) {
                    setSavedEvents(JSON.parse(getSavedData))
                }
            } catch (error) {
                console.log("SavedEvents AsyncStorage: ", error)
            }
        }

        fetchAsyncStorage()
    }, [fastRefetch])

    useEffect(() => {
        const fetchData = async () => {
            try {
                const eventsResponse = await fetch(`${API_PATH}?events=-1&author=-1`, {
                    method: 'GET',
                });
                const eventsJson = await eventsResponse.json();
                // console.log("[=====Events Json======]", eventsJson)
                // console.log("[=====Events Json Stringify======]", JSON.stringify(eventsJson))
                setEvents(eventsJson)
            } catch (error) {
                console.log("[=====Fetch Events ERR======]", error)
            }
        };
        fetchData();
    }, [refetch])

    const onEventPress = (eventId: any, isSavedEvent: any, savedAmounts: number) => {
        // console.log("[==EventDetails==]")
        navigation.navigate('EventDetails', { eventId: eventId, isSavedEvent: isSavedEvent, savedAmounts: savedAmounts })
        // console.log("[==EventDetails==]")
    }

    const renderList = ({ item }: any) => {
        return (
            <>
                {
                    new Date(item.date).toDateString() === new Date().toDateString() &&
                    <EventCard
                        onPress={onEventPress.bind(null, item.id, (savedEvents.filter((event: any) => { return event.id === item.id }).length > 0), savedEvents.length)}
                        item={item}
                        isSavedEvent={savedEvents.filter((event: any) => { return event.id === item.id }).length > 0}
                        navigation={navigation}
                    />
                }
            </>
        )
    }
    return (
        <View style={Styles.container}>
            <FlatList
                data={events}
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