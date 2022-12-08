import { Box, Grid, Image } from "@chakra-ui/react";
import React from "react";
import connect from "@frontity/connect";
import Link from "@frontity/components/link";

const BrandList = ({ state, libraries, actions }) => {
  //  const searchSlug = `/searchresult-for/${inputValue}`;
  const brandName = [
    {
      slug: "/sneaker-release-dates/brands/nike",
      image:
        "https://aws.fastsole.co.uk/wp-content/uploads/2022/06/Rectangle-417-1.png",
    },

    {
      slug: "/sneaker-release-dates/brands/adidas",
      image:
        "https://aws.fastsole.co.uk/wp-content/uploads/2022/06/Rectangle-422.png",
    },
    {
      slug: "/sneaker-release-dates/brands/puma",
      image:
        "https://aws.fastsole.co.uk/wp-content/uploads/2022/06/Rectangle-419-1.png",
    },
    {
      slug: "/sneaker-release-dates/brands/jordan",
      image:
        "https://aws.fastsole.co.uk/wp-content/uploads/2022/06/Rectangle-421-1.png",
    },
    {
      slug: "/sneaker-release-dates/brands/converse/",
      image:
        "https://aws.fastsole.co.uk/wp-content/uploads/2022/06/Rectangle-420-1.png",
    },
    {
      slug: "/sneaker-release-dates/brands/new-balance",
      image:
        "https://aws.fastsole.co.uk/wp-content/uploads/2022/05/balanace.png",
    },
  ];
  // const slug = `/sneaker-release-dates/brands/${result}`;
  return (
    <Grid
      // py={2}
      mx="8px !important"
      templateColumns={{
        md: "1fr 1fr 1fr 1fr 1fr 1fr",
        base: "repeat(3, 1fr)",
      }}
      textColor="white"
      gap={4}
      justifyItems="center"
    >
      {/* SearchResultForNike */}

      {brandName.map((item) => {
        return (
          <Link link={item.slug}>
            {" "}
            <Box
              border="1px solid #D8DEE7"
              bg="#F3F4F7"
              _hover={{ bg: "#3E485D", color: "#ffff" }}
              rounded="lg"
              w={{ base: "100%", md: "100%", lg: "100%" }}
            >
              <img
                borderRadius="lg"
                width="170px"
                height="100px"
                src={item.image}
              />
            </Box>
          </Link>
        );
      })}
    </Grid>
  );
};

export default connect(BrandList);
