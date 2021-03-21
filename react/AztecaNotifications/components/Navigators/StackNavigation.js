import React from 'react';
import { Text, View, Button, Animated, Platform } from 'react-native'
import { NavigationContainer } from '@react-navigation/native';
import { createStackNavigator } from '@react-navigation/stack';
import Icon from 'react-native-vector-icons/Ionicons';

const Stack = createStackNavigator();

const Home = ({ navigation }) => {
    return (
        <View
            style={{
                flex:1,
                justifyContent: "center",
                alignItems: "center",
                backgroundColor: "#03cafc"
            }}>
            <Text
                style={{
                    fontSize: 20,
                    fontWeight: "800",
                    color: "#fff"
                }}
            >INICIO</Text>
            <Button
                title="Ir a Contacto"
                onPress={() => navigation.navigate("Contact")}
            />
        </View>
    )
}

const Contact = ({ navigation }) => {
    return (
        <View
            style={{
                flex:1,
                justifyContent: "center",
                alignItems: "center",
                backgroundColor: "#c203fc"
            }}>
            <Text
                style={{
                    fontSize: 20,
                    fontWeight: "800",
                    color: "#fff"
                }}
            >CONTACTO</Text>
            <Button
                title="Ir a Sobre nosotros"
                onPress={() => navigation.navigate("About")}
            />
        </View>
    )
}

const About = ({ navigation }) => {
    return (
        <View
            style={{
                flex:1,
                justifyContent: "center",
                alignItems: "center",
                backgroundColor: "#48d969"
            }}>
            <Text>SOBRE NOSOTROS</Text>
            <Button
                title="Ir a Principal"
                onPress={() => navigation.navigate("Home")}
            />
        </View>
    )
}

const MyStack = () => {
    return (
        <Stack.Navigator>
            <Stack.Screen
                name="Home"
                component={Home}
                options={{
                    headerTintColor: "white",
                    headerStyle: { backgroundColor: "green" }
                }}
            />
            <Stack.Screen
                name="Contact"
                component={Contact}
                options={{
                    headerStyleInterpolator: forFade
                }}
            />
            <Stack.Screen
                name="About"
                component={About}
                options={{
                    headerStyleInterpolator: forFade
                }}
            />
        </Stack.Navigator>
    )
}

const forFade = () => {
    const opacity = Animated.add(
        current.progress,
        next ? next.progress : 0
    ).interpolate({
        inputRange: [0, 1, 2],
        outputRange: [0, 1, 0]
    });

    return {
        leftButtonStyle: { opacity },
        rightButtonStyle: { opacity },
        titleStyle: { opacity },
        backgroundStyle: { opacity }
    };
};

const StackNavigation = () => {
    return (
        <NavigationContainer>
            <MyStack />
        </NavigationContainer>
    )
}

export default StackNavigation;