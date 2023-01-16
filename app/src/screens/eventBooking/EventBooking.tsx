import { View, Text, StyleSheet, Image, ScrollView } from 'react-native'
import React, { useState } from 'react'
import Container from '../../components/Container'
import { ButtonWithRightIcon, Header } from '../../components'
import { Colors, Fonts, Images } from '../../res'
import { hp, Typography, wp } from '../../global'
import { SliderBox } from "react-native-image-slider-box";

const EventBooking = (props: any) => {
    const [event, setEvent] = useState({
        images: [
            "https://goosebumps.finance/images/unknown_token.png",
            "https://goosebumps.finance/images/unknown_token.png",
            "https://goosebumps.finance/images/unknown_token.png",
            "https://goosebumps.finance/images/unknown_token.png",
        ],
        name: 'Heavy is the Head',
        description: 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt.',
        stormzy: 'Stormzy',
        attendees: 44,
        date: 'Fri, May 6, 2021',
        time: '10:00AM',
        fee: 5600
    })

    const RenderField = ({ icon, name }: any) => {
        return (
            <View style={Styles.renderFieldInnerCon}>
                <Image
                    source={icon}
                    resizeMode='contain'
                    style={Styles.fieldIcon}
                />
                <Text style={Styles.fieldName}>
                    {name}
                </Text>
            </View>
        )
    }

    const onProceedPress = () => props.navigation.navigate('EventBookingCard')


    return (
        <Container>
            <Header
                centetText="Book an Event"
                navigation={props.navigation}
            />
            <ScrollView showsVerticalScrollIndicator={false} contentContainerStyle={{ flexGrow: 1 }}>
                <Text style={Styles.description}>
                    You are about to pay for
                </Text>
                <View style={[Styles.eventBoxContainer, Styles.shadow]}>
                    <SliderBox
                        images={event.images}
                        disableOnPress
                        sliderBoxHeight={hp(25)}
                        parentWidth={wp(90)}
                        imageLoadingColor={Colors.theme}
                        dotColor={Colors.color3}
                    />
                    <Text style={Styles.eventName}>
                        {event.name}
                    </Text>
                    <Text style={Styles.eventDescription}>
                        {event.description}
                    </Text>
                    <View style={Styles.renderFieldCon}>
                        <RenderField
                            icon={Images.micTheme}
                            name={event.stormzy}
                        />
                        <RenderField
                            icon={Images.users}
                            name={`${event.attendees} attendees`}
                        />
                    </View>
                    <View style={Styles.renderFieldCon}>
                        <RenderField
                            icon={Images.calender}
                            name={event.date}
                        />
                        <RenderField
                            icon={Images.time}
                            name={event.time}
                        />
                    </View>
                </View>
                <View style={Styles.buttonOuterContainer}>
                    <View style={Styles.eventFeeCon}>
                        <Text style={Styles.eventFeeTxt}>
                            Event Fee
                        </Text>
                        <Text style={Styles.eventFeeTxt}>
                            <Text style={{ ...Styles.eventFeeTxt, color: Colors.color19 }}>
                                $ </Text>
                            {event.fee}
                        </Text>
                    </View>
                    <ButtonWithRightIcon
                        text="Proceed"
                        onPress={onProceedPress}
                    />
                </View>
            </ScrollView>
        </Container>
    )
}

export default EventBooking

const Styles = StyleSheet.create({
    description: {
        color: Colors.color5,
        fontFamily: Fonts.APPFONT_R,
        fontSize: Typography.medium,
        marginHorizontal: wp(6),
        marginTop: hp(3)
    },
    eventBoxContainer: {
        marginHorizontal: wp(5),
        marginVertical: hp(3),
        backgroundColor: Colors.color2,
        paddingBottom: hp(4),
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
    eventName: {
        color: Colors.theme,
        fontFamily: Fonts.APPFONT_B,
        fontSize: Typography.small3,
        marginHorizontal: wp(5),
        marginTop: hp(2.5)
    },
    eventDescription: {
        color: Colors.color7,
        fontFamily: Fonts.APPFONT_R,
        fontSize: Typography.small3,
        marginHorizontal: wp(5),
        marginTop: hp(1)
    },
    renderFieldCon: {
        flexDirection: 'row',
        justifyContent: 'space-between',
        alignItems: 'center',
        paddingHorizontal: wp(7),
        marginTop: hp(3)
    },
    renderFieldInnerCon: {
        flexDirection: 'row',
        alignItems: 'center',
        justifyContent: 'flex-start',
        width: wp(30),
    },
    fieldName: {
        fontFamily: Fonts.APPFONT_M,
        fontSize: Typography.small2,
        marginLeft: wp(3),
        color: Colors.theme
    },
    fieldIcon: {
        width: hp(3),
        height: hp(3.2),
    },
    buttonOuterContainer: {
        position: 'absolute',
        width: wp(100),
        bottom: 0,
        paddingVertical: hp(4)
    },
    eventFeeCon: {
        borderWidth: 1,
        borderColor: Colors.color18,
        alignSelf: 'center',
        width: wp(80),
        marginBottom: hp(2),
        borderRadius: 4,
        paddingVertical: wp(4),
        flexDirection: 'row',
        justifyContent: 'space-between',
        alignItems: 'center',
        paddingHorizontal: wp(4)
    },
    eventFeeTxt: {
        color: Colors.color5,
        fontFamily: Fonts.APPFONT_B,
        fontSize: Typography.small3
    }
})