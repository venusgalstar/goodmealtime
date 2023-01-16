import { View, Text, StyleSheet, FlatList, ScrollView, TouchableOpacity, Image } from 'react-native'
import React from 'react'
import { Colors, Fonts, } from '../../res'
import { hp, Typography, wp } from '../../global'
import { Constants } from '../../global'
import Entypo from 'react-native-vector-icons/Entypo'

const Meals = (props: any) => {
    const {
        data = [],
        navigation = {}
    } = props

    const onFoodItemPress = (foodId: any) => navigation.navigate('FoodDetails', { foodId: foodId })

    const renderCategoryItems = ({ item, index }: any) => {
        return (
            <TouchableOpacity style={{
                ...Styles.itemOuterContainer,
                backgroundColor: index % 2 === 0 ? Colors.color11 : Colors.color3
            }}
                activeOpacity={Constants.btnActiveOpacity}
                onPress={onFoodItemPress.bind(null, item.id)}
            >
                <Image
                    source={{ uri: item.image }}
                    resizeMode='cover'
                    style={Styles.itemImage}
                />
                <View style={Styles.itemContentCon}>
                    <Text style={Styles.itemName}
                        numberOfLines={1}
                    >
                        {item.name}
                    </Text>
                    <Text style={Styles.itemPrice} numberOfLines={1}>
                        ${item.price}
                    </Text>
                    <View style={Styles.itemLocationCon}>
                        <Entypo name='location-pin' color={Colors.color4} size={wp(4)} />
                        <Text
                            style={Styles.itemLocation}
                            numberOfLines={1}
                        >
                            {item.location}
                        </Text>
                    </View>
                </View>
            </TouchableOpacity>
        )
    }


    const renderCategory = ({ item }: any) => {
        return (
            <View style={[Styles.categoryContainer, Styles.shadow]}>
                <View style={Styles.categoryHeaderCon}>
                    <Text style={Styles.categoryHeader}>
                        {Object.keys(item)[0]}
                    </Text>
                    <TouchableOpacity
                        activeOpacity={Constants.btnActiveOpacity}
                    >
                        <Text style={Styles.viewAllTxt}>View All</Text>
                    </TouchableOpacity>
                </View>

                <ScrollView
                    horizontal
                    showsHorizontalScrollIndicator={false}
                    contentContainerStyle={Styles.itemListContainer}
                >
                    <FlatList
                        data={item[Object.keys(item)[0]]}
                        numColumns={Math.ceil(item[Object.keys(item)[0]].length / 2)}
                        renderItem={renderCategoryItems}
                        showsVerticalScrollIndicator={false}
                        showsHorizontalScrollIndicator={false}
                    />
                </ScrollView>
            </View>
        )
    }
    return (
        <View style={[Styles.container, Styles.shadow]}>
            <FlatList
                data={data}
                renderItem={renderCategory}
                contentContainerStyle={Styles.listContainer}
                showsVerticalScrollIndicator={false}
            />
        </View>
    )
}

export default Meals

const Styles = StyleSheet.create({
    container: {
        flex: 1,
        backgroundColor: Colors.color2,
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
    listContainer: {
        paddingVertical: hp(2),
        paddingHorizontal: wp(2)
    },
    categoryContainer: {
        marginVertical: hp(1),
        marginHorizontal: wp(1),
        borderRadius: 8,
        paddingVertical: hp(2),
        backgroundColor: Colors.color2,
    },
    categoryHeaderCon: {
        flexDirection: 'row',
        paddingHorizontal: wp(3),
        justifyContent: 'space-between',
        alignItems: 'center'
    },
    categoryHeader: {
        color: Colors.color7,
        fontSize: Typography.medium,
        fontFamily: Fonts.APPFONT_R
    },
    viewAllTxt: {
        color: Colors.color4,
        fontFamily: Fonts.APPFONT_R,
        fontSize: Typography.medium
    },
    itemListContainer: {
        marginLeft: wp(3),
        marginTop: hp(1.5),
    },
    itemOuterContainer: {
        marginRight: wp(1),
        width: wp(35),
        height: hp(26),
        marginTop: hp(0.6)
    },
    itemImage: {
        width: wp(35),
        height: hp(15)
    },
    itemContentCon: {
        paddingVertical: hp(1),
        paddingHorizontal: wp(2)
    },
    itemName: {
        color: Colors.color5,
        fontSize: Typography.small3,
        fontFamily: Fonts.APPFONT_R,
        maxWidth: wp(30)
    },
    itemPrice: {
        color: Colors.color4,
        fontSize: Typography.small3,
        fontFamily: Fonts.APPFONT_BL,
        maxWidth: wp(30),
        marginTop: hp(0.5)
    },
    itemLocation: {
        color: Colors.color5,
        fontFamily: Fonts.APPFONT_R,
        fontSize: Typography.small,
        maxWidth: wp(25)
    },
    itemLocationCon: {
        flexDirection: 'row',
        alignItems: 'center',
        paddingTop: hp(1),
        marginLeft: wp(-0.5)
    }
})