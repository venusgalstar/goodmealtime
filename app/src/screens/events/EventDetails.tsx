import { View, Text, StyleSheet, StatusBar, ScrollView, TouchableOpacity, Dimensions, Image, Platform } from 'react-native'
import React, { useState } from 'react'
import { Colors, Fonts } from '../../res'
import AntDesign from 'react-native-vector-icons/AntDesign'
import { Images } from '../../res'
import { SliderBox } from "react-native-image-slider-box";
import { Constants, hp, Typography, wp } from '../../global';

const EventDetails = (props: any) => {
    const [event, setEvent] = useState({
        images: [
            "https://source.unsplash.com/1024x768/?nature",
            "https://source.unsplash.com/1024x768/?water",
            "https://source.unsplash.com/1024x768/?girl",
            "https://source.unsplash.com/1024x768/?tree",
        ],
        name: 'The Speed of Now (Live Performance)',
        description: 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt.',
        price: 'Free',
        discount: '500',
        liveNow: true,
        date: 'Thu, May 5, 2021',
        time: '08:50AM',
        allDayEvent: true,
        attendees: 44,
        liveStreamUrl: "https://source.unsplash.com/1024x768/?nature",
        host: 'Will Smith',
        presenters: [{
            name: 'Keith Urban',
            starPresenter: true
        },
        {
            name: 'Birds of Tokyo',
            starPresenter: false
        },
        {
            name: 'Stomzy',
            starPresenter: false
        }],
        createdBy: 'Dept for Digital Culture, Media & Sports',
        accessRestrictions: 'Staff, VIPs, Executive Members, All Executives of DDCMS',
        gate: '6',
        seating: 'Free',
        eventManager: 'Alice Susan'
    })
    const onBackPress = () => props.navigation.goBack()
    const onSaveForLaterPress = () => props.navigation.navigate('SavedEvents')
    const onBookNowPress = () => props.navigation.navigate('EventBooking')

    const RenderFieldList = (props: any) => {
        const { icon, heading, description, first, presenters } = props
        return (
            <View style={{ ...Styles.listInnerView, marginTop: first ? 0 : hp(1.5) }}>
                <Image
                    source={icon}
                    resizeMode='contain'
                    style={Styles.listIcon}
                />
                <View style={Styles.listInnerViewTwo}>
                    <Text style={Styles.listInnerHeading}>
                        {heading}:
                    </Text>
                    <View style={Styles.listInnerDesView}>
                        {
                            presenters ?
                                description.map((element: any, index: any) => (
                                    <Text style={{ ...Styles.listDescription, marginBottom: hp(0.5) }}
                                        key={index}
                                    >
                                        {element.name}
                                        {element.starPresenter &&
                                            <Text style={{ ...Styles.listDescription, marginBottom: hp(0.5), color: Colors.color7 }}>
                                                {' '}(Star Presenter)
                                            </Text>}
                                    </Text>
                                ))
                                :
                                <Text style={Styles.listDescription}>
                                    {description}
                                </Text>
                        }
                    </View>
                </View>
            </View>
        )
    }

    return (
        <View style={Styles.container}>
            <StatusBar translucent backgroundColor={'transparent'} barStyle='dark-content' />
            <ScrollView showsVerticalScrollIndicator={false} contentContainerStyle={{ paddingBottom: hp(15) }}>
                <View style={Styles.imageSliderCon}>
                    <SliderBox
                        images={event.images}
                        disableOnPress
                        sliderBoxHeight={hp(35)}
                        imageLoadingColor={Colors.theme}
                        dotColor={Colors.color3}
                    />
                    <View style={Styles.headerContainer}>
                        <TouchableOpacity style={Styles.headerBtn}
                            activeOpacity={Constants.btnActiveOpacity}
                            onPress={onBackPress}
                        >
                            <AntDesign name='arrowleft' color={Colors.color3} size={wp(6)} />
                        </TouchableOpacity>
                        <TouchableOpacity style={{ ...Styles.headerBtn, backgroundColor: Colors.color3, }}
                            activeOpacity={Constants.btnActiveOpacity}
                        >
                            <AntDesign name='hearto' color={Colors.theme} size={wp(5)} />
                            <View style={Styles.headerBadgeView}>
                                <Text style={Styles.headerBadgeTxt}>4</Text>
                            </View>
                        </TouchableOpacity>
                    </View >
                </View>
                <View style={Styles.contentOuterView}>
                    <Text style={Styles.eventName}>{event.name}</Text>
                    <Text style={Styles.eventDesc}>{event.description}</Text>
                    <View style={Styles.priceOuterCon}>
                        <View style={Styles.priceView}>
                            <Image
                                source={Images.dollar}
                                resizeMode='contain'
                                style={Styles.listIcon}
                            />
                            <Text style={Styles.price}>{event.price}</Text>
                            <Text style={Styles.discount}>{event.discount}</Text>
                        </View>
                        {
                            event.liveNow &&
                            <View style={Styles.priceView}>
                                <View style={Styles.liveIcon} />
                                <Text style={Styles.liveNow}>Live Now</Text>
                            </View>
                        }
                    </View>
                </View>
                <View style={Styles.contentOuterView}>
                    <View style={{ ...Styles.contentInnerView, marginTop: 0 }}>
                        <Image
                            source={Images.calender}
                            resizeMode='contain'
                            style={Styles.listIcon}
                        />
                        <Text style={Styles.date}>{event.date}</Text>
                    </View>
                    <View style={Styles.contentInnerView}>
                        <Image
                            source={Images.time}
                            resizeMode='contain'
                            style={Styles.listIcon}
                        />
                        <Text style={Styles.date}>{event.time}</Text>
                        {
                            event.allDayEvent &&
                            <View style={{ ...Styles.contentInnerView, marginTop: 0 }}>
                                <View style={Styles.allDayEventDot} />
                                <Text style={Styles.allDayEvent}>All Day Event</Text>
                            </View>
                        }
                    </View>
                    <View style={{ ...Styles.contentInnerView, marginTop: hp(1) }}>
                        <Image
                            source={Images.users}
                            resizeMode='contain'
                            style={Styles.listIcon}
                        />
                        <Text style={Styles.date}>{event.attendees} Attendees</Text>
                    </View>
                </View>
                <View style={Styles.contentOuterView}>
                    <View style={Styles.contentInnerViewSB}>
                        <View style={{ ...Styles.contentInnerView, marginTop: 0 }}>
                            <Image
                                source={Images.urlAttach}
                                resizeMode='contain'
                                style={Styles.listIcon}
                            />
                            <Text style={Styles.liveStreamUrl}>Livestream Url</Text>
                        </View>
                        <TouchableOpacity
                            activeOpacity={Constants.btnActiveOpacity}
                            style={Styles.copyBtn}
                        >
                            <Image
                                source={Images.copy}
                                resizeMode='contain'
                                style={Styles.listIcon}
                            />
                        </TouchableOpacity>
                    </View>
                    <View style={Styles.contentInnerViewSB}>
                        <View style={Styles.contentInnerView}>
                            <Image
                                source={Images.googleCalender}
                                resizeMode='contain'
                                style={Styles.listIcon}
                            />
                            <Text style={{ ...Styles.liveStreamUrl, color: Colors.color12 }}>
                                Google Calendar Link
                            </Text>
                        </View>
                        <TouchableOpacity
                            activeOpacity={Constants.btnActiveOpacity}
                            style={Styles.copyBtn}
                        >
                            <Image
                                source={Images.copy}
                                resizeMode='contain'
                                style={Styles.listIcon}
                            />
                        </TouchableOpacity>
                    </View>
                </View>
                <View style={Styles.contentOuterView}>
                    <RenderFieldList
                        heading={"Host"}
                        description={event.host}
                        icon={Images.host}
                        first={true}
                    />
                    <RenderFieldList
                        heading={"Presenter(s)"}
                        description={event.presenters}
                        icon={Images.micTheme}
                        presenters={true}
                    />
                    <RenderFieldList
                        heading={"Created by"}
                        description={event.createdBy}
                        icon={Images.bulb}
                    />
                </View>
                <View style={Styles.contentOuterView}>
                    <RenderFieldList
                        heading={"Access Restrictions"}
                        description={event.accessRestrictions}
                        icon={Images.key}
                        first={true}
                    />
                    <RenderFieldList
                        heading={"Gate"}
                        description={event.gate}
                        icon={Images.logout}
                    />
                    <RenderFieldList
                        heading={"Seating"}
                        description={event.seating}
                        icon={Images.seat}
                    />
                </View>
                <View style={Styles.contentOuterView}>
                    <RenderFieldList
                        heading={"Event Manager"}
                        description={event.eventManager}
                        icon={Images.eventManager}
                        first={true}
                    />
                </View>
            </ScrollView >
            <View style={{ ...Styles.btnsOuterCon, ...Styles.shadow }}>
                <TouchableOpacity style={{ ...Styles.bookNowBtn, borderWidth: 1, borderColor: Colors.theme, backgroundColor: Colors.color3, }}
                    activeOpacity={Constants.btnActiveOpacity}
                    onPress={onSaveForLaterPress}
                >
                    <AntDesign name='heart' color={Colors.theme} size={wp(5)} />
                    <Text style={{ ...Styles.bookNow, color: Colors.theme }}>
                        Save For Later
                    </Text>
                </TouchableOpacity>
                <TouchableOpacity style={Styles.bookNowBtn}
                    activeOpacity={Constants.btnActiveOpacity}
                    onPress={onBookNowPress}
                >
                    <Image
                        source={Images.calenderWhite}
                        resizeMode='contain'
                        style={Styles.listIcon}
                    />
                    <Text style={Styles.bookNow}>Book Now</Text>
                </TouchableOpacity>
            </View>
        </View >
    )
}

export default EventDetails


const { width } = Dimensions.get('window')
const Styles = StyleSheet.create({
    container: {
        flex: 1,
        backgroundColor: Colors.color2,
    },
    imageSliderCon: {
        height: hp(35)
    },
    headerContainer: {
        top: 0,
        position: 'absolute',
        width: wp(100),
        paddingTop: hp(6),
        paddingHorizontal: wp(5),
        flexDirection: 'row',
        alignItems: 'center',
        justifyContent: 'space-between'
    },
    headerBtn: {
        width: width * 0.09,
        height: width * 1 * 0.09,
        borderRadius: width * 1 * 0.09 / 2,
        backgroundColor: Colors.color5,
        justifyContent: 'center',
        alignItems: 'center'
    },
    headerBadgeView: {
        width: width * 0.025,
        height: width * 1 * 0.025,
        borderRadius: width * 1 * 0.025 / 2,
        backgroundColor: Colors.color9,
        justifyContent: 'center',
        alignItems: 'center',
        position: 'absolute',
        top: hp(0.5),
        right: wp(1.5)
    },
    headerBadgeTxt: {
        fontSize: wp(2),
        color: Colors.color2,
        fontFamily: Fonts.APPFONT_B
    },
    contentOuterView: {
        borderBottomWidth: Platform.OS === 'ios' ? 0.5 : 1,
        borderBottomColor: Colors.color10,
        paddingHorizontal: wp(5),
        paddingVertical: hp(2)
    },
    eventName: {
        color: Colors.theme,
        fontFamily: Fonts.APPFONT_B,
        fontSize: Typography.medium2,
    },
    eventDesc: {
        fontSize: Typography.small3,
        textAlign: 'justify',
        fontFamily: Fonts.APPFONT_R,
        color: Colors.color5,
        marginTop: hp(1)
    },
    priceOuterCon: {
        borderWidth: 0,
        flexDirection: 'row',
        justifyContent: "space-between",
        alignItems: 'center',
        paddingTop: hp(2)
    },
    priceView: {
        flexDirection: 'row',
        alignItems: 'center',
    },
    listIcon: {
        width: hp(3),
        height: hp(3.2),
    },
    price: {
        color: Colors.color5,
        fontSize: Typography.medium2,
        fontFamily: Fonts.APPFONT_B,
        marginHorizontal: wp(2)
    },
    discount: {
        color: Colors.color4,
        fontSize: Typography.medium2,
        fontFamily: Fonts.APPFONT_R,
        textDecorationLine: 'line-through'
    },
    liveIcon: {
        width: width * 0.025,
        height: width * 1 * 0.025,
        borderRadius: width * 1 * 0.025 / 2,
        backgroundColor: Colors.color8,
        marginTop: hp(0.2)
    },
    liveNow: {
        color: Colors.color5,
        fontSize: Typography.small2,
        fontFamily: Fonts.APPFONT_R,
        marginLeft: wp(2)
    },
    contentInnerView: {
        flexDirection: 'row',
        alignItems: 'center',
        marginTop: hp(1.5),
    },
    date: {
        color: Colors.color5,
        fontSize: Typography.small3,
        fontFamily: Fonts.APPFONT_R,
        marginLeft: wp(2)
    },
    allDayEventDot: {
        width: width * 0.017,
        height: width * 1 * 0.017,
        borderRadius: width * 1 * 0.017 / 2,
        backgroundColor: Colors.theme,
        marginHorizontal: wp(2)
    },
    allDayEvent: {
        color: Colors.color7,
        fontSize: Typography.small3,
        fontFamily: Fonts.APPFONT_R,
    },
    liveStreamUrl: {
        color: Colors.color9,
        fontSize: Typography.small3,
        fontFamily: Fonts.APPFONT_B,
        marginLeft: wp(2)
    },
    copyBtn: {
        width: width * 0.085,
        height: width * 1 * 0.085,
        borderRadius: width * 1 * 0.085 / 2,
        justifyContent: 'center',
        alignItems: 'center',
        backgroundColor: Colors.color3
    },
    contentInnerViewSB: {
        flexDirection: 'row',
        justifyContent: 'space-between',
        alignItems: 'center',
    },
    listInnerView: {
        flexDirection: 'row',
        marginTop: hp(1.5),
    },
    listInnerViewTwo: {
        marginLeft: wp(2),
        flexDirection: 'row',
        justifyContent: 'space-between',
        width: wp(81),
        marginTop: hp(0.5)
    },
    listInnerHeading: {
        color: Colors.theme,
        fontSize: Typography.small3,
        fontFamily: Fonts.APPFONT_R,
        width: wp(35)
    },
    listInnerDesView: {
        width: wp(46),
    },
    listDescription: {
        color: Colors.color5,
        fontSize: Typography.small3,
        fontFamily: Fonts.APPFONT_R,
    },
    btnsOuterCon: {
        width: wp(100),
        position: 'absolute',
        bottom: 0,
        borderWidth: Platform.OS === 'ios' ? 0 : 0.5,
        borderColor: Colors.color10,
        backgroundColor: Colors.color2,
        paddingVertical: hp(3),
        borderTopLeftRadius: 20,
        borderTopRightRadius: 20,
        flexDirection: 'row',
        alignItems: 'center',
        justifyContent: 'space-between',
        paddingHorizontal: wp(8)
    },
    shadow: {
        shadowColor: Colors.color1,
        shadowOffset: {
            width: 0,
            height: 10,
        },
        shadowOpacity: 0.53,
        shadowRadius: 13.97,
        elevation: 30,
    },
    bookNowBtn: {
        backgroundColor: Colors.theme,
        borderRadius: 4,
        flexDirection: 'row',
        alignItems: 'center',
        justifyContent: 'center',
        height: 45.47,
        width: wp(40)
    },
    bookNow: {
        color: Colors.color2,
        marginLeft: wp(3),
        fontFamily: Fonts.APPFONT_B,
        fontSize: Typography.small3
    }
})