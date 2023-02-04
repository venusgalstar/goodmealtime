import { View, StyleSheet, FlatList, Text, ScrollView } from 'react-native'
import React, { useState, useEffect, useContext } from 'react'
import AsyncStorage from '@react-native-async-storage/async-storage'
import { Fonts, Colors, Images } from '../../res'
import { wp, hp, Typography } from '../../global'
import EventCard from './EventCard'
import { SAVE_EVENT, FAST_REFETCH, REFETCH, API_PATH } from '../../config'
import { AppStateContext } from '../../App'
import { getDistance } from '../../utils'

enum POSITION {
    TODAY,
    TOMORROW,
    WEEK,
    MONTH,
    MONTH3,
    MONTH6,
    MONTH6PLUS
}

const POSITION_STRING = ["Today", "Tomorrow", "This Week", "This Month", "3 Months", "6 Months", "6 Months +"]

const getPosition = (pos: number[], value: number) => {
    var low = 0;
    var high = pos[0] - 1;
    for (var i = 0; i < pos.length - 1; i++) {
        if ((low <= value) && (value <= high)) return i;
        low = low + pos[i];
        high = high + pos[i + 1];
    }
    return pos.length - 1
}

const Events = (props: any) => {
    const {
        author = -1,
        navigation = {}
    } = props

    const [refetch, setRefetch] = useState(true)
    const [events, setEvents] = useState([])
    const [todayEvents, setTodayEvents] = useState([])
    const [tmrEvents, setTmrEvents] = useState([])
    const [weekEvents, setWeekEvents] = useState([])
    const [monthEvents, setMonthEvents] = useState([])
    const [threeMEvents, setThreeMEvents] = useState([])
    const [sixMEvents, setSixMEvents] = useState([])
    const [sixPlusMEvents, setSixPlusMEvents] = useState([])
    // const [concatEvents, setConcatEvents] = useState([])
    const [positions, setPositions] = useState<number[]>([])
    const [isLoading, setIsLoading] = useState(false)

    const geo = useContext(AppStateContext)

    const compareEvents = (event1: any, event2: any) => {
        const diff1 = getDistance(event1.location_latitude, event1.location_longitude, geo.coords.latitude, geo.coords.longitude)
        const diff2 = getDistance(event2.location_latitude, event2.location_longitude, geo.coords.latitude, geo.coords.longitude)

        if (isNaN(diff1) && isNaN(diff2)) return 0
        if (isNaN(diff1)) return 1
        if (isNaN(diff2)) return -1
        if (diff1 === diff2) return 0
        if (diff1 < diff2) return -1
        if (diff1 > diff2) return 1
        return 0
    }

    useEffect(() => {
        // console.log("[===useContext geo===]", geo)
        const _sortedEvents = events.sort(compareEvents)
        // console.log("[===_sortedEvents===]", _sortedEvents)

        const today = Date.parse(new Date().toString());
        const _todaySortedEvents = _sortedEvents.filter((item: any) => {
            return (Date.parse(item.event_start_date) <= today) && (today <= Date.parse(item.event_end_date))
        })
        // console.log("[===_todaySortedEvents===]", _todaySortedEvents)
        setTodayEvents(_todaySortedEvents)

        const tmr = today + 24 * 3600 * 1000;
        const _tmrSortedEvents = _sortedEvents.filter((item: any) => {
            return (Date.parse(item.event_start_date) <= tmr) && (tmr <= Date.parse(item.event_end_date))
        })
        // console.log("[===_tmrSortedEvents===]", _tmrSortedEvents)
        setTmrEvents(_tmrSortedEvents)

        const thisWeek = today + (6 - new Date().getDay()) * 24 * 3600 * 1000;
        const _weekSortedEvents = _sortedEvents.filter((item: any) => {
            return (Date.parse(item.event_start_date) <= tmr) && (thisWeek <= Date.parse(item.event_end_date))
        })
        // console.log("[===_weekSortedEvents===]", _weekSortedEvents)
        setWeekEvents(_weekSortedEvents)

        const thisMonth = Date.parse(new Date(new Date().getFullYear(), new Date().getMonth() + 1, 0).toString());
        const _monthSortedEvents = _sortedEvents.filter((item: any) => {
            return (Date.parse(item.event_start_date) <= thisWeek) && (thisMonth <= Date.parse(item.event_end_date))
        })
        // console.log("[===_monthSortedEvents===]", _monthSortedEvents)
        setMonthEvents(_monthSortedEvents)

        const threeMonth = Date.parse(new Date(new Date().getFullYear(), new Date().getMonth() + 3, 0).toString());
        const _threeMEvents = _sortedEvents.filter((item: any) => {
            return (Date.parse(item.event_start_date) <= thisMonth) && (threeMonth <= Date.parse(item.event_end_date))
        })
        // console.log("[===_threeMEvents===]", _threeMEvents)
        setThreeMEvents(_threeMEvents)

        const sixMonth = Date.parse(new Date(new Date().getFullYear(), new Date().getMonth() + 6, 0).toString());
        const _sixMEvents = _sortedEvents.filter((item: any) => {
            return (Date.parse(item.event_start_date) <= threeMonth) && (sixMonth <= Date.parse(item.event_end_date))
        })
        // console.log("[===_sixMEvents===]", _sixMEvents)
        setSixMEvents(_sixMEvents)

        const _sixPlusMEvents = _sortedEvents.filter((item: any) => {
            return Date.parse(item.event_start_date) > sixMonth
        })
        // console.log("[===_sixPlusMEvents===]", _sixPlusMEvents)
        setPositions([
            _todaySortedEvents.length,
            _tmrSortedEvents.length,
            _weekSortedEvents.length,
            _monthSortedEvents.length,
            _threeMEvents.length,
            _sixMEvents.length,
            _sixPlusMEvents.length
        ])

        // const _concatEvents = _todaySortedEvents
        //     .concat(_tmrSortedEvents)
        //     .concat(_weekSortedEvents)
        //     .concat(_monthSortedEvents)
        //     .concat(_threeMEvents)
        //     .concat(_sixMEvents)
        //     .concat(_sixPlusMEvents)
        // // console.log("[===concat===]", _concatEvents)
        // setConcatEvents(_concatEvents)
        setIsLoading(true)
    }, [events, geo])

    useEffect(() => {
        // console.log("[===Events data===]", data)
        const timerID = setInterval(() => {
            setRefetch((prevRefetch) => {
                return !prevRefetch;
            });
        }, REFETCH);

        return () => {
            clearInterval(timerID);
        };
    }, []);

    useEffect(() => {
        const fetchData = async () => {
            try {
                const eventsResponse = await fetch(`${API_PATH}?events=-1&author=${author}`, {
                    method: 'GET',
                });
                const eventsJson = await eventsResponse.json();
                // console.log("[=====Events Json======]", eventsJson)
                console.log("[=====Events Json length======]", eventsJson.length)
                // console.log("[=====Events Json Stringify======]", JSON.stringify(eventsJson))
                setEvents(eventsJson)
            } catch (error) {
                console.log("[=====Fetch Events ERR======]", error)
            }
        };
        fetchData();
    }, [refetch])

    const renderList = ({ item }: any) => {
        return (
            <EventCard
                item={item}
                navigation={navigation}
            />
        )
    }

    return (
        <View style={Styles.container}>
            <ScrollView
                showsHorizontalScrollIndicator={false}
                contentContainerStyle={Styles.itemListContainer}
            >
                <View style={Styles.outerDateCon}>
                    <View style={Styles.innerTodayConLine} />
                    <View style={Styles.outerDateCon}>
                        <Text style={Styles.itemDateDay}>Today</Text>
                        <Text style={Styles.itemDate}>|</Text>
                        <Text style={Styles.itemDate}>{new Date().toDateString()}</Text>
                    </View>
                    <View style={Styles.innerTodayConLine} />
                </View>
                {/* {
                    todayEvents && todayEvents.map((event: any, key) => {

                    })
                } */}
                <View style={Styles.outerDateCon}>
                    <View style={Styles.innerConLine} />
                    <View style={Styles.outerDateCon}>
                        <Text style={Styles.itemDateDay}>Tomorrow</Text>
                    </View>
                    <View style={Styles.innerConLine} />
                </View>
                {/* <FlatList
                    nestedScrollEnabled={true}
                    data={tmrEvents}
                    renderItem={renderList}
                    showsVerticalScrollIndicator={false}
                    contentContainerStyle={Styles.listContainer}
                /> */}
            </ScrollView>
        </View>
    )
}

export default Events

const Styles = StyleSheet.create({
    outerDateCon: {
        flexDirection: 'row',
        alignItems: 'center',
        justifyContent: 'space-between'
    },
    innerTodayConLine: {
        borderTopWidth: 0.4,
        width: wp(25)
    },
    innerConLine: {
        borderTopWidth: 0.4,
        width: wp(35)
    },
    itemDateDay: {
        fontFamily: Fonts.APPFONT_B,
        color: Colors.color5,
        fontSize: Typography.small2
    },
    itemDate: {
        fontFamily: Fonts.APPFONT_R,
        color: Colors.color5,
        marginLeft: wp(1),
        fontSize: Typography.small2
    },
    container: {
        flex: 1,
    },
    listContainer: {
        paddingHorizontal: wp(4),
    },
    shadow: {
        shadowColor: Colors.color1,
        shadowOffset: {
            width: 0,
            height: 1,
        },
        shadowOpacity: 0.22,
        shadowRadius: 2.22,
        elevation: 3,
    },
    categoryContainer: {
        marginVertical: hp(1),
        marginHorizontal: wp(1),
        borderRadius: 5,
        paddingVertical: hp(2),
        backgroundColor: Colors.color2,
    },
    itemListContainer: {
        marginLeft: wp(1),
        marginTop: hp(1),
    },
})