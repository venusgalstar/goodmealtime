import { View, Text, StyleSheet, FlatList, Image, Dimensions, TouchableOpacity, Platform } from 'react-native'
import React from 'react'
import { Animation } from '../../animations'
import { Constants, hp, Typography, wp } from '../../global'
import { Fonts, Colors, Images } from '../../res'
import Ionicons from 'react-native-vector-icons/Ionicons'
import AntDesign from 'react-native-vector-icons/AntDesign'

const EventCard = (props: any) => {
    const {
        item = {},
        onPress = () => null
    } = props
    return (
        <View style={Styles.itemContainer}>
            <View style={Styles.outerDateCon}>
                <View style={Styles.innerConLine} />
                <View style={Styles.outerDateCon}>
                    <Text style={Styles.itemDateDay}>Today</Text>
                    <Text style={Styles.itemDate}>|</Text>
                    <Text style={Styles.itemDate}>{item.date}</Text>
                </View>
                <View style={Styles.innerConLine} />
            </View>
            <TouchableOpacity style={[Styles.contentOuterCon, Styles.shadow]}
                activeOpacity={Constants.btnActiveOpacity}
                onPress={() => {
                    // console.log("[=================prince start=================]", props);
                    // console.log("[=================prince start=================]", item);
                    // onPress.bind(null, item)
                    onPress()
                    // console.log("[=================prince end11=================]", item);
                }}
            >
                <View style={Styles.contentInnerCon}>
                    <View style={Styles.contentInnerConOne}>
                        <Text style={Styles.itemHeading}>
                            {item.title}
                        </Text>
                        <Text
                            style={Styles.itemDesc}
                            numberOfLines={2}
                        >
                            {item.description}
                        </Text>
                        <View style={Styles.contentInnerConOneInnerCon}>
                            <View style={Styles.contentInnerConOneInnerConInner}>
                                <Image
                                    source={Images.multimediaMic}
                                    resizeMode='contain'
                                    style={Styles.micIcon}
                                />
                                <Text style={Styles.itemName}>
                                    {item.name}
                                </Text>
                            </View>
                            <View style={Styles.contentInnerConOneInnerConInner}>
                                <Image
                                    source={Images.priceTag}
                                    resizeMode='contain'
                                    style={Styles.micIcon}
                                />
                                <Text style={Styles.itemTicket}>
                                    ₦{item.ticket}
                                </Text>
                            </View>
                        </View>
                    </View>
                    <Image
                        source={{ uri: item.image }}
                        resizeMode="cover"
                        style={Styles.itemImage}
                    />
                </View>
                <View style={Styles.contentInnerCon}>
                    <View style={{ ...Styles.contentInnerConOneInnerCon, width: wp(64), paddingHorizontal: wp(2.5) }}>
                        <View style={Styles.liveCon}>
                            <View style={Styles.liveIcon} />
                            <Text style={Styles.liveNowTxt}>Live Now</Text>
                        </View>
                        <View style={Styles.liveCon}>
                            <Image
                                source={Images.users}
                                resizeMode='contain'
                                style={Styles.userIcon}
                            />
                            <Text style={{ ...Styles.liveNowTxt, color: Colors.color5 }}>
                                {item.peopleAttending}
                            </Text>
                        </View>
                        <View style={Styles.liveCon}>
                            <Ionicons
                                name='time-outline'
                                color={Colors.color5}
                                size={wp(4)}
                            />
                            <Text style={{ ...Styles.liveNowTxt, color: Colors.color5 }}>
                                {item.time}
                            </Text>
                        </View>
                    </View>
                    <View style={Styles.bookHeartCon}>
                        <TouchableOpacity style={Styles.heartBtn}
                            activeOpacity={Constants.btnActiveOpacity}
                        >
                            <AntDesign name='hearto' color={Colors.theme} size={wp(4)} />
                        </TouchableOpacity>
                        <TouchableOpacity
                            activeOpacity={Constants.btnActiveOpacity}
                            style={Styles.bookBtn}
                        >
                            <Text style={Styles.bookTxt}>Book</Text>
                        </TouchableOpacity>
                    </View>
                </View>

            </TouchableOpacity>
        </View>
    )
}

export default EventCard

const { width } = Dimensions.get('window')
const Styles = StyleSheet.create({
    itemContainer: {
        marginTop: hp(3),
        marginBottom: hp(1)
    },
    outerDateCon: {
        flexDirection: 'row',
        alignItems: 'center',
        justifyContent: 'space-between'
    },
    innerConLine: {
        borderTopWidth: 0.4,
        width: wp(30)
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
    contentOuterCon: {
        backgroundColor: Colors.color2,
        marginTop: hp(2)
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
    contentInnerCon: {
        flexDirection: 'row',
        justifyContent: 'space-between',
    },
    contentInnerConOne: {
        width: wp(69),
        paddingTop: hp(1),
        borderBottomWidth: 0.5,
        borderBottomColor: Colors.color7,
        paddingHorizontal: wp(2.5),
    },
    itemImage: {
        width: wp(23),
        height: wp(25),
    },
    itemHeading: {
        color: Colors.color6,
        fontFamily: Fonts.APPFONT_B,
        fontSize: Typography.small3,
        maxWidth: wp(64),
    },
    itemDesc: {
        color: Colors.color7,
        fontFamily: Fonts.APPFONT_R,
        fontSize: Typography.small2,
        maxWidth: wp(64),
    },
    contentInnerConOneInnerCon: {
        marginTop: hp(0.5),
        flexDirection: 'row',
        justifyContent: 'space-between',
        alignItems: 'center',
    },
    contentInnerConOneInnerConInner: {
        flexDirection: 'row',
        alignItems: 'center',
    },
    micIcon: {
        width: wp(4),
        height: hp(3),
    },
    itemName: {
        fontSize: Typography.small1,
        fontFamily: Fonts.APPFONT_R,
        color: Colors.color5,
        marginLeft: wp(2),
        maxWidth: wp(30)
    },
    itemTicket: {
        color: Colors.color5,
        fontFamily: Fonts.APPFONT_B,
        fontSize: Typography.small1,
        marginLeft: wp(2)
    },
    liveCon: {
        flexDirection: 'row',
        alignItems: 'center',
        marginBottom: hp(0.8),
    },
    liveIcon: {
        width: width * 0.025,
        height: width * 1 * 0.025,
        borderRadius: width * 1 * 0.025 / 2,
        backgroundColor: Colors.color8,
        marginTop: hp(0.2)
    },
    liveNowTxt: {
        color: Colors.color9,
        fontFamily: Fonts.APPFONT_R,
        marginLeft: wp(2),
        fontSize: Typography.small1
    },
    userIcon: {
        width: wp(4.5),
        height: hp(3),
    },
    bookHeartCon: {
        width: wp(23),
        flexDirection: 'row',
        alignItems: 'center',
        justifyContent: 'space-between'
    },
    heartBtn: {
        borderWidth: 1,
        height: hp(3.2),
        width: wp(7),
        justifyContent: 'center',
        alignItems: 'center',
        borderRadius: 4,
        borderColor: Colors.theme
    },
    bookBtn: {
        borderWidth: 1,
        width: wp(14),
        height: hp(3.2),
        marginRight: wp(1),
        flexDirection: 'row',
        alignItems: 'center',
        justifyContent: 'center',
        paddingHorizontal: wp(1),
        backgroundColor: Colors.theme,
        borderRadius: 4
    },
    bookTxt: {
        color: Colors.color3,
        fontFamily: Fonts.APPFONT_B

    }
})