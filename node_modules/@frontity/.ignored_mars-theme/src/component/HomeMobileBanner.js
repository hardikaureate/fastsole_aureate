import React from "react";
import Carousel from "react-multi-carousel";
import { AspectRatio, Box, Text } from "@chakra-ui/react";
import { Image } from "@chakra-ui/image";
import ImageViewFeatured from "../Utils/ImageViewFeatured";
import connect from "@frontity/connect";
import dayjs from "dayjs";
import Link from "@frontity/components/link";

const HomeMobileBanner = ({ state, actions, libraries, props }) => {
  const Html2React = libraries.html2react.Component;
  // const date = dayjs(item.date_gmt).format("DD MMMM YYYY");
  const responsive = {
    superLargeDesktop: {
      // the naming can be any, depends on you.
      breakpoint: { max: 4000, min: 3000 },
      items: 0,
    },
    desktop: {
      breakpoint: { max: 3000, min: 767 },
      items: 0,
    },
    tablet: {
      breakpoint: { max: 768, min: 464 },
      items: 2,
    },
    mobile: {
      breakpoint: { max: 464, min: 0 },
      items: 1,
    },
  };

  return (
    <div>

      <Carousel
        responsive={responsive}
        display={{ base: "block", md: "block", lg: "none" }}
      >
        {props.slice(0, 4).map((postss, i) => {
          //const item = state.source[type][id];
          return (
            <Link link={postss.link}>
              <Box mx="3" rounded="xl" border="1px solid #D8DEE7">
                <Box flexShrink={0} className="newsMobile">
                  <Image src={postss.fimg_url} loading="lazy" />
                  {/* <ImageViewFeatured id={item.featured_media} /> */}
                </Box>
                <Box mt={{ base: 4, md: 0 }} ml={{ md: 6 }} m="4">
                  <Text mb="2" color="#7887A5">
                    {dayjs(postss.date).format("DD MMMM YYYY")}
                  </Text>
                  <Text
                    // mt={1}
                    // isTruncated
                    noOfLines={2}
                    fontSize="lg"
                    lineHeight="normal"
                    fontWeight="semibold"
                    href="#"
                    fontStyle="normal"
                    fontFamily="Martel"
                    color={"#3E485D"}
                    pb="1"
                  >
                    {<Html2React html={postss.title.rendered} />}
                  </Text>
                </Box>
              </Box>
            </Link>
          );
        })}
      </Carousel>

    </div>
  );
};

export default connect(HomeMobileBanner);
