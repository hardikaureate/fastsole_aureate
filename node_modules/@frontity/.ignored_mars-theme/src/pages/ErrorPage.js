import React from "react";
import { Center, Text, Button, Box } from "@chakra-ui/react";

const ErrorPage = () => {
  return (
    <>
      <Center>
        <div className="notfound">
          <div className="notfound-404">
            <h1>4<span>0</span>4</h1>
          </div>

          <div style={{ fontSize: "25px", fontWeight: "bold", letterSpacing: "2px", marginBottom: "15px" }}>
            Error: 404 page not found
          </div>
          <div style={{ color: "#3e485d", fontSize: "20px", marginBottom: "20px" }}>
            Sorry, the page you're looking for cannot be accessed
          </div>
          <a href="/" target="_self" className="homebtn">
            <Button>Go to Homepage</Button>
          </a>
        </div>

      </Center>
    </>
  );
};

export default ErrorPage;
