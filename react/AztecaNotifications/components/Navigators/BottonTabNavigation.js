import React from 'react';
import { Text, View, Button, Platform } from 'react-native'
import { NavigationContainer } from '@react-navigation/native';
import { createBottomTabNavigator } from '@react-navigation/bottom-tabs';
import Icon from 'react-native-vector-icons/Ionicons';

function Home() {
    return (
        <View style={{flex:1, justifyContent: "center", alignItems: "center", backgroundColor: "#03cafc"}}>
            <Text style={{ fontSize: 20, color: "#fff", fontWeight: "800"}}>Home</Text>
        </View>
    )
}

function Contact({ navigation }) {
    return (
        <View style={{flex:1, justifyContent: "center", alignItems: "center", backgroundColor: "#c203fc"}}>
            <Text style={{ fontSize: 20, color: "#fff", fontWeight: "800"}}>Contact</Text>
            <Button title="Atras" onPress={() => navigation.goBack()} />
        </View>
    )
}

function About({ navigation }) {
    return (
        <View style={{flex:1, justifyContent: "center", alignItems: "center", backgroundColor: "#48d969"}}>
            <Text style={{ fontSize: 20, color: "#fff", fontWeight: "800"}}>About</Text>
            <Button title="Atras" onPress={() => navigation.goBack()} />
        </View>
    )
}

const Tab = createBottomTabNavigator();

function MyTabs() {
    return (
        <Tab.Navigator
            initialRouterName="Home"
            tabBarOptions={{
                activeTintColor: '#e91e63'
            }}>
            <Tab.Screen
                name="Home"
                component={Home}
                options={{
                    tabBarLabel: "Home",
                    tabBarIcon: ({ color, size }) => (
                        <Icon name={Platform.OS === 'ios' ? "ios-home" : "md-home"} color={color} size={size} />
                    )
                }}
            />
            <Tab.Screen
                name="Contact"
                component={Contact}
                options={{
                    tabBarLabel: "Contact",
                    tabBarIcon: ({ color, size }) => (
                        <Icon name={Platform.OS === 'ios' ? "ios-contacts" : "md-contacts"} color={color} size={size} />
                    )
                }}
            />
            <Tab.Screen
                name="About"
                component={About}
                options={{
                    tabBarLabel: "About",
                    tabBarIcon: ({ color, size }) => (
                        <Icon name={Platform.OS === 'ios' ? "ios-information-cicle" : "md-information-circle"} color={color} size={size} />
                    )
                }}
            />
        </Tab.Navigator>
    )
}

const BottonTabNavigtion = () => {
    return (
        <NavigationContainer>
            <MyTabs />
        </NavigationContainer>
    )
}

export default BottonTabNavigtion;