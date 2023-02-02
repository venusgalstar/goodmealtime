import { View, Text, StyleSheet, FlatList, ScrollView, TouchableOpacity, Image } from 'react-native'
import React, { useState, useEffect } from 'react'
import { Colors, Fonts, Images } from '../../res'
import { hp, Typography, wp } from '../../global'
import { Constants } from '../../global'
import Entypo from 'react-native-vector-icons/Entypo'
import { API_PATH, REFETCH } from '../../config'
// import { mealsData1 } from '../home/Data'

const MealCard = (props: any) => {
    const {
        item = null,
        index = null,
        navigation = {}
    } = props

    // const [isAvailable, setIsAvailable] = useState(false)

    // const onAvailablePress = (eventbookingId: any) => {
    //     console.log("[=====onAvailablePress======]", isAvailable)
    //     setIsAvailable(prev => !prev)
    //     // TODO+
    // }

    const onFoodItemPress = (foodId: any) => navigation.navigate('FoodDetails', { foodId: foodId })
    return (
        <TouchableOpacity style={{
            ...Styles.itemOuterContainer,
            backgroundColor: index % 2 === 0 ? Colors.color11 : Colors.color3
        }}
            activeOpacity={Constants.btnActiveOpacity}
            onPress={onFoodItemPress.bind(null, item.id)}
        >
            {
                item.image ? (
                    <Image
                        source={{ uri: item.image }}
                        resizeMode='cover'
                        style={Styles.itemImage}
                    />
                ) : (
                    <Image
                        source={Images.unknownImages}
                        resizeMode='cover'
                        style={Styles.itemImage}
                    />
                )
            }
            <View style={Styles.itemContentCon}>
                <Text style={Styles.itemName}
                    numberOfLines={1}
                >
                    {item.name}
                </Text>
                <Text style={Styles.itemPrice} numberOfLines={1}>
                    ₦{item.price}
                </Text>
                {/* <TouchableOpacity
                    style={isAvailable ? Styles.bookBtn : Styles.bookBtnWhite}
                    activeOpacity={Constants.btnActiveOpacity}
                    onPress={onAvailablePress.bind(null, item.id)}
                >
                    <Text style={isAvailable ? Styles.bookTxt : Styles.bookTxtWhite}>Available</Text>
                </TouchableOpacity> */}
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

const Meals = (props: any) => {
    const {
        navigation = {}
    } = props

    const [refetch, setRefetch] = useState(true);
    const [meals, setMeals] = useState<any[]>([])

    useEffect(() => {
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
                const mealsResponse = await fetch(`${API_PATH}?meals=-1`, {
                    method: 'GET',
                });
                const mealsJson = await mealsResponse.json();
                // console.log("[=====Meals Json======]", mealsJson)
                const products = mealsJson[0].category
                const groupByCategory = products.reduce((group: any, product: any) => {
                    const { restaurant } = product;
                    group[restaurant] = group[restaurant] ?? [];
                    group[restaurant].push(product);
                    return group;
                }, {});
                var newArray: any[] = [];
                Object.keys(groupByCategory).map((value, index) => {
                    newArray.push({ [value]: groupByCategory[value] })
                })
                // console.log(newArray);
                setMeals(newArray)
            } catch (error) {
                console.log("[=====Fetch Meals ERR======]", error)
            }
        };
        fetchData();
    }, [refetch])

    const onEventsPress = (author: any) => 
    {
        console.log("[===onEventsPress===]", author)
        navigation.navigate('Home', { tabId: 0, author: author })
    }

    const renderCategoryItems = ({ item, index }: any) => {
        return (
            <MealCard
                item={item}
                index={index}
                navigation={navigation}
            />
        )
    }

    const renderCategory = ({ item }: any) => {
        return (
            <View style={[Styles.categoryContainer, Styles.shadow]}>
                <View style={Styles.outerDateCon}>
                    <View style={Styles.innerConLine} />
                    <View style={Styles.outerDateCon}>
                        <Text style={Styles.itemDateDay}>Today</Text>
                        <Text style={Styles.itemDate}>|</Text>
                        <Text style={Styles.itemDate}>{new Date().toDateString()}</Text>
                    </View>
                    <View style={Styles.innerConLine} />
                </View>
                <View style={Styles.categoryHeaderCon}>
                    <Text style={Styles.categoryHeader}>
                        {Object.keys(item)[0]}
                    </Text>
                    <TouchableOpacity
                        activeOpacity={Constants.btnActiveOpacity}
                        onPress={onEventsPress.bind(null, item[Object.keys(item)[0]][0].author)}
                    >
                        <Text style={Styles.viewAllTxt}>View Event</Text>
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
                data={meals}
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
    },
    outerDateCon: {
        flexDirection: 'row',
        alignItems: 'center',
        justifyContent: 'space-between'
    },
    innerConLine: {
        borderTopWidth: 0.4,
        width: wp(25)
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
    }
    // bookBtn: {
    //     borderWidth: 1,
    //     width: wp(21),
    //     height: hp(3.2),
    //     marginRight: wp(1),
    //     flexDirection: 'row',
    //     alignItems: 'center',
    //     justifyContent: 'center',
    //     paddingHorizontal: wp(1),
    //     backgroundColor: Colors.color2,
    //     borderRadius: 4
    // },
    // bookTxt: {
    //     color: Colors.theme,
    //     fontFamily: Fonts.APPFONT_B
    // },
    // bookBtnWhite: {
    //     borderWidth: 1,
    //     width: wp(21),
    //     height: hp(3.2),
    //     marginRight: wp(1),
    //     flexDirection: 'row',
    //     alignItems: 'center',
    //     justifyContent: 'center',
    //     paddingHorizontal: wp(1),
    //     backgroundColor: Colors.theme,
    //     borderRadius: 4
    // },
    // bookTxtWhite: {
    //     color: Colors.color2,
    //     fontFamily: Fonts.APPFONT_B
    // }
})