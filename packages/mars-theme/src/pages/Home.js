import { useState, useEffect } from "react";
import {
  Grid,
  GridItem,
  Box,
  Stack,
  Image,
  Heading,
  Text,
  Icon,
  Divider,
  Button,
  Flex,
  VStack,
  Spinner,
  Center,
} from "@chakra-ui/react";
import React from "react";
import {
  FaAngleRight,
  FaBell,
  FaCheckCircle,
  FaClock,
  FaRegHeart,
  FaChevronRight,
} from "react-icons/fa";
import { connect, Head, loadable } from "frontity";
//import ComingSoonSlider from "../component/ComingSoonSlider";
//import FocusOnSlider from "../component/FocusOnSlider";
//import TopBrandSlider from "../component/TopBrandSlider";
//import FooterComponent from "../component/FooterComponent";
import Link from "@frontity/components/link";
//import HomeMobileBanner from "../component/HomeMobileBanner";
import dayjs from "dayjs";
import FeaturedMedia from "../Utils/FeaturedMedia";
import ImageView from "../Utils/ImageView";
import { motion } from "framer-motion";
import { css } from "frontity";
// import Slider1 from "../component/slider/slider1";
// import Link from "@frontity/components/link";
//import ImageViewFeatured from "../../src/Utils/ImageViewFeatured";
//import BrandList from "../component/BrandList";
//import ViewAllbtn from "../component/ViewAllbtn";
//import ViewAllMobile from "../component/ViewAllMobile";
import Skbrand from "../component/Skeleton/skbrand";

const ComingSoonSlider = loadable(() => import('../component/ComingSoonSlider'))
const FocusOnSlider = loadable(() => import('../component/FocusOnSlider'))
const TopBrandSlider = loadable(() => import('../component/TopBrandSlider'))
const BrandList = loadable(() => import('../component/BrandList'))
const FooterComponent = loadable(() => import('../component/FooterComponent'))

const ViewAllbtn = loadable(() => import('../component/ViewAllbtn'))
const ViewAllMobile = loadable(() => import('../component/ViewAllMobile'))

//const ImageViewFeatured = loadable(() => import('../../src/Utils/ImageViewFeatured'))
const HomeMobileBanner = loadable(() => import('../component/HomeMobileBanner'))


function useHover() {
  const [hovering, setHovering] = useState(false);
  const onHoverProps = {
    onMouseEnter: () => setHovering(true),
    onMouseLeave: () => setHovering(false),
  };
  return [hovering, onHoverProps];
}

function Home({ state, actions, libraries }) {
  const [buttonAIsHovering, buttonAHoverProps] = useHover();
  const [buttonBIsHovering, buttonBHoverProps] = useHover();

  // console.log(window);
  const path = state.router.link;
  const Html2React = libraries.html2react.Component;

  const data = state.source.get(state.router.link).items;

  const pageData = state.source.data["/"];
  // state.source.get(state.router.link);
  // state.source.data["/"];
  // state.source.get(state.router.link);

  const schemaData = pageData.schemaData && pageData.schemaData;

  {
    // schemaData && console.log("chekcechema=", schemaData.schema);
  }
  const [load, setLoad] = useState(true);
  const [posts, setPosts] = useState([]);
  useEffect(() => {
    setTimeout(() => {
      setLoad(false);
    }, 50);
  }, []);


  const fetchPosts = async () => {
    const res = await fetch("https://aws.fastsole.co.uk/wp-json/wp/v2/posts");
    const data = await res.json();
    try {
      setPosts(data);
      //console.log(data);
    } catch (err) {
      console.log(err);
    }
  };

  useEffect(() => {
    fetchPosts();
  }, []);


  return (
    <>
      <Head>      
        <meta
          data-rh="true"
          name="thumbnail"
          content="https://dev2.fastsole.co.uk/wp-content/uploads/2016/09/FastSole-Fev-01.png"
          data-reactroot=""
        />
        <meta
          data-rh="true"
          name="viewport"
          content="width=device-width, initial-scale=1"
          data-reactroot=""
        />
        <meta
          data-rh="true"
          property="fb:app_id"
          content=""
          data-reactroot=""
        />
        <meta data-rh="true" data-rh="true" charset="utf-8" data-reactroot="" />
        <meta
          data-rh="true"
          property="og:locale"
          content="en_GB"
          data-reactroot=""
        />
        <meta
          data-rh="true"
          property="og:type"
          content="website"
          data-reactroot=""
        />
        <meta
          data-rh="true"
          property="og:site_name"
          content="Fastsole"
          data-reactroot=""
        />
        <meta
          data-rh="true"
          name="twitter:card"
          content="summary"
          data-reactroot=""
        />
        <meta
          data-rh="true"
          name="twitter:site"
          content="@Fastsole"
          data-reactroot=""
        />
        <meta
          data-rh="true"
          name="twitter:creator"
          content="@Fastsole"
          data-reactroot=""
        />
        <meta
          data-rh="true"
          name="description"
          content="Find the latest sneaker news, release dates, prices and where to buy. Fastsole keeps you up to date with the latest footwear rumours and releases."
          data-reactroot=""
        />
        <meta
          data-rh="true"
          property="og:title"
          content="Sneaker Release Dates 2022 | Sneaker News UK 2022 | Fastsole "
          data-reactroot=""
        />
        <meta
          data-rh="true"
          property="og:description"
          content="Find the latest sneaker news, release dates, prices and where to buy. Fastsole keeps you up to date with the latest footwear rumours and releases."
          data-reactroot=""
        />
        <meta
          data-rh="true"
          property="og:url"
          content="Fastsole"
          data-reactroot=""
        />
        <meta
          data-rh="true"
          name="twitter:title"
          content="Sneaker Release Dates 2022 | Sneaker News UK 2022 | Fastsole "
          data-reactroot=""
        />
        <meta
          data-rh="true"
          name="twitter:description"
          content="Find the latest sneaker news, release dates, prices and where to buy. Fastsole keeps you up to date with the latest footwear rumours and releases."
          data-reactroot=""
        />

        <title data-rh="true">
          Sneaker Release Dates 2022 | Sneaker News UK 2022 | Fastsole
        </title>
      </Head>
      <script data-rh="true" type="application/ld+json">
        {`{
          "@context": "https://schema.org",
          "@type": "Organization",
          url: "https://dev2.fastsole.co.uk",
          sameAs: [
            "https://www.facebook.com/fastsole/",
            "https://www.instagram.com/fastsole/",
            "https://twitter.com/FastSoleUK",
          ],
          address: {
            "@type": "PostalAddress",
            addressCountry: "GB",
            addressLocality: "22 Trinity Trees",
            addressRegion: "Eastbourne",
            postalCode: "BN21 3LE",
            streetAddress: "16 Windermere Court",
          },
          founder: {
            "@type": "Person",
            email: "info@fastsole.co.uk",
            name: "Shah Aktaruzzaman",
            givenName: "Shah",
            familyName: "Aktaruzzaman",
            jobTitle: "CEO",
          },
          contactPoint: [
            {
              "@type": "ContactPoint",
              email: "info@fastsole.co.uk",
              telephone: "447896880951",
              contactType: "General inquiries",
            },
            {
              "@type": "ContactPoint",
              email: "info@fastsole.co.uk",
              contactType: "Sales and advertising",
            },
          ],
          "@id": "https://dev2.fastsole.co.uk/#organization",
          name: "Fast sole",
          logo: "https://dev2.fastsole.co.uk/wp-content/themes/fs/img/logo.png",
        }`}
      </script>

      <Stack mx={{ base: "6", md: "16", lg: "40" }}>
        <Stack my={6} mx={2} display={{ base: "none", md: "none", lg: "grid" }}>
          <Grid
            templateColumns={{ md: "3fr 3fr  ", sm: "repeat(2, 1fr)" }}
            textColor="white"
            gap={4}
          >

            {posts.slice(0, 1).map((post, index) => {
              return (
                post && (
                  <Box key={index}>
                    <Link link={post.link}>
                      <Image src={post.fimg_url} loading="lazy" className="newhomeImage" />
                      {/* <ImageViewFeatured id={item.featured_media} /> */}
                    </Link>

                    <Link link={post.link}>
                      <Heading
                        as="h3"
                        mt={6}
                        _hover={{ textDecoration: "none" }}
                        _focus={{ boxShadow: "none" }}
                        fontSize={{ base: "md", md: "md", lg: "xl", xl: "2xl" }}
                        fontWeight="bold"
                        color="#3E485D"
                        lineHeight="normal"
                        mb="10px"
                      >
                        <div dangerouslySetInnerHTML={{ __html: post.title.rendered }} />
                      </Heading>
                    </Link>
                    <Text
                      color={"#3E485D"}
                      display="flex"
                      alignItems="flex-end"
                      fontSize={{ base: "md", md: "md", lg: "sm", xl: "md" }}
                    >
                      <Html2React
                        html={`${post.excerpt.rendered.substring(0, 100)}  ...`}
                      />
                    </Text>
                    <Box w="max-content">
                      <Link link={post.link}>
                        <Text color="red">
                          Read more
                          <Icon as={FaChevronRight} boxSize="2" color={"red"} />
                        </Text>
                      </Link>
                    </Box>
                  </Box>
                )
              )
            })}

            <Box display="flex">
              <VStack alignItems="normal" justifyContent={"space-between"}>
                {/* {data.slice(1, 4).map(({ type, id }) => { */}
                {posts.slice(1, 4).map((post, index) => {
                  //const item = state.source[type][id];

                  if (post.status == "instock") {
                    var status = (
                      <Text
                        color="#3EB75E"
                        fontSize="xs"
                        mr="2"
                        lineHeight="22px"
                      >
                        <Icon
                          as={FaCheckCircle}
                          boxSize="3"
                          mr={1}
                          color={"#3EB75E"}
                        />
                        In Stock
                      </Text>
                    );
                  } else if (post.status == "coming_soon") {
                    var status = (
                      <Text color="#FF6600" fontSize="xs" lineHeight="22px">
                        <Icon
                          as={FaClock}
                          boxSize="3"
                          mr={1}
                          color={"#FF6600"}
                        />
                        Coming Soon
                      </Text>
                    );
                  } else if (post.status == "publish") {
                    var status = (
                      <Text
                        color="#3EB75E"
                        fontSize="xs"
                        mr="2"
                        lineHeight="22px"
                      >
                        <Icon
                          as={FaCheckCircle}
                          boxSize="3"
                          mr={1}
                          color={"#3EB75E"}
                        />
                        Publish
                      </Text>
                    );
                  } else if (post.status == "restock") {
                    var status = (
                      <Text color="#FF6600" fontSize="xs" lineHeight="22px">
                        <Icon
                          as={FaClock}
                          boxSize="3"
                          mr={1}
                          color={"#FF6600"}
                        />
                        Re Stock
                      </Text>
                    );
                  } else if (post.status == "delayed") {
                    var status = (
                      <Text color="#FF6600" fontSize="xs" lineHeight="22px">
                        <Icon
                          as={FaClock}
                          boxSize="3"
                          mr={1}
                          color={"#FF6600"}
                        />
                        Delayed
                      </Text>
                    );
                  } else if (post.status == "sold_out") {
                    var status = (
                      <Text color="#FF6600" fontSize="xs" lineHeight="22px">
                        <Icon
                          as={FaClock}
                          boxSize="3"
                          mr={1}
                          color={"#FF6600"}
                        />
                        Sold Out
                      </Text>
                    );
                  } else if (post.status == "stockist_sold_out") {
                    var status = (
                      <Text color="#FF6600" fontSize="xs" lineHeight="22px">
                        <Icon
                          as={FaClock}
                          boxSize="3"
                          mr={1}
                          color={"#FF6600"}
                        />
                        Stocklist Sold Out
                      </Text>
                    );
                  } else {
                    var status = (
                      <Text color="#FF6600" fontSize="xs" lineHeight="22px">
                        <Icon
                          as={FaClock}
                          boxSize="3"
                          mr={1}
                          color={"#FF6600"}
                        />
                        Nothing
                      </Text>
                    );
                  }

                  return (
                    <Box
                      display={{ md: "flex" }}
                      // mb="5px "
                      alignItems="center"
                      h={"100%"}
                    >
                      <Box
                        flexShrink={0}
                        width={{
                          base: "100%",
                          md: "50%",
                          lg: "50%",
                          xl: "47%",
                        }}
                        height={"95%"}
                        borderRadius={"5px"}
                        border={"1px solid #C2C8D6"}
                      >
                        <Link link={post.link} id="img-div2nd-height">
                          <Image src={post.fimg_url} loading="lazy" className="newhomeImage" />
                          {/* <Image src={item.yoast_head_json.og_image[0].url} alt={item.title.rendered} height="auto" width="100%" max-width="100%" max-height="100%" loading="lazy" /> */}
                        </Link>
                      </Box>
                      <Box mt={{ base: 4, md: 0 }} ml={{ md: 4 }}>
                        <Link link={post.link}>
                          <Heading
                            as="h3"
                            display="block"
                            fontSize={{
                              base: "md",
                              md: "md",
                              lg: "sm",
                              xl: "lg",
                            }}
                            color="#3E485D"
                            lineHeight="normal"
                            noOfLines={2}
                          >
                            {<Html2React html={post.title.rendered} />}
                          </Heading>
                        </Link>
                        <Box>
                          <Text
                            as="span"
                            color="#3E485D"
                            fontSize={{
                              base: "md",
                              md: "md",
                              lg: "sm",
                              xl: "md",
                            }}
                            lineHeight="normal"
                            mt="2px"
                            noOfLines={2}
                          >
                            {
                              <Html2React
                                html={`${post.excerpt.rendered.substring(
                                  0,
                                  50
                                )}  ...`}
                              />
                            }
                          </Text>
                        </Box>

                        <Flex mt="2px" alignItems="center">
                          <Box w="max-content">
                            <Link link={post.link}>
                              <Text color="red">
                                Read more
                                <Icon
                                  as={FaChevronRight}
                                  boxSize="2"
                                  color={"red"}
                                />
                              </Text>
                            </Link>
                          </Box>
                        </Flex>
                      </Box>
                    </Box>
                  );
                })}
              </VStack>
            </Box>
          </Grid>

          {/* banner */}
        </Stack>

        <Stack py={6}>
          <HomeMobileBanner props={posts} />
        </Stack>

        {/* <Divider /> */}

        <Stack pb={2}>
          <Flex justifyContent="space-between" alignItems="baseline" mx={2}>
            <Heading
              as="h2"
              // mb={4}
              fontSize={{ base: "lg", md: "lg", lg: "xl", xl: "xl" }}
              color={"#3E485D"}
              fontWeight="bold"
              fontStyle="normal"
            >
              Top Brands
            </Heading>
            <ViewAllbtn link="/sneaker-release-dates/brands" />
          </Flex>

          {/* <Skbrand /> */}

          {load ? (
            <Center spacing={4} my={20}>
              <Spinner
                size="xl"
                thickness="4px"
                speed="0.65s"
                emptyColor="gray.200"
                color="#718096"
                my={5}
              />
            </Center>
          ) : (
            <TopBrandSlider />
          )}

          <Stack
            mx="auto !important"
            mt="0px !important"
            mb="20px !important"
            display={{ base: "block", md: "none" }}
          >
            <ViewAllMobile link="/sneaker-release-dates/brands" />
          </Stack>
        </Stack>

        {/* <Divider /> */}

        <Stack pt={{ base: "5px", md: "51px" }}>
          <Flex justifyContent="space-between" alignItems="baseline" mx={2}>
            <Heading
              as="h2"
              // mb={4}
              fontSize={{ base: "lg", md: "lg", lg: "xl", xl: "xl" }}
              color={"#3E485D"}
              fontWeight="bold"
              fontStyle="normal"
            >
              On Focus
            </Heading>

            <ViewAllbtn link="sneaker-release-dates/status/on-focus/" />
          </Flex>

          {load ? (
            <Center spacing={4} my={20}>
              <Spinner
                size="xl"
                thickness="4px"
                speed="0.65s"
                emptyColor="gray.200"
                color="#718096"
                my={5}
              />
            </Center>
          ) : (
            <FocusOnSlider />
          )}
          <Stack
            mx="auto !important"
            mt="7px !important"
            mb="20px !important"
            display={{
              base: "block",
              md: "none",
            }}
          >
            <ViewAllMobile link="sneaker-release-dates/status/on-focus/" />
          </Stack>
        </Stack>

        {/* <Divider /> */}

        <Stack pt={{ base: "5px", md: "51px" }}>
          <Flex justifyContent="space-between" alignItems="baseline" mx={2}>
            <Heading
              // mb={4}
              as="h2"
              fontSize={{ base: "lg", md: "lg", lg: "xl", xl: "xl" }}
              color={"#3E485D"}
              fontWeight="bold"
              fontStyle="normal"
            >
              Coming Soon
            </Heading>

            <ViewAllbtn link="sneaker-release-dates/status/coming-soon/" />
          </Flex>

          {load ? (
            <Center spacing={4} my={20}>
              <Spinner
                size="xl"
                thickness="4px"
                speed="0.65s"
                emptyColor="gray.200"
                color="#718096"
                my={5}
              />
            </Center>
          ) : (
            <ComingSoonSlider />
          )}
          <Stack
            mx="auto !important"
            mt="7px !important"
            mb="20px !important"
            display={{ base: "block", md: "none" }}
          >
            <ViewAllMobile link="sneaker-release-dates/status/coming-soon/" />
          </Stack>
        </Stack>

        {/* barndlist */}
        <BrandList />

        {/* <Divider /> */}

        <Stack pt={{ base: "25px", md: "51px" }}>
          <Flex justifyContent="space-between" alignItems="baseline" mx={2}>
            <Heading
              as="h2"
              // mb={4}
              fontSize={{ base: "lg", md: "lg", lg: "xl", xl: "xl" }}
              color={"#3E485D"}
              fontWeight="bold"
              fontStyle="normal"
              lineHeight="normal"
            >
              Latest News
            </Heading>

            <ViewAllbtn link="/sneaker-news/" />
          </Flex>

          <Grid
            templateColumns={{ md: "3fr 3fr  ", sm: "repeat(2, 1fr)" }}
            textColor="white"
            gap={4}
          >
            {posts.slice(4, 5).map((post, index) => {
              //const item = state.source[type][id];

              return (
                post && (
                  <Box key={index}>
                    <Link link={post.link}>
                      {/* <ImageViewFeatured id={item.featured_media} /> */}
                      <Image src={post.fimg_url} loading="lazy" className="newhomeImage" />
                      {/* <Image src={item.yoast_head_json.og_image[0].url} alt={item.title.rendered} height="auto" width="100%" max-width="100%" max-height="100%" loading="lazy" /> */}
                    </Link>

                    <Link link={post.link}>
                      <Heading
                        as="h3"
                        mt={6}
                        _hover={{ textDecoration: "none" }}
                        _focus={{ boxShadow: "none" }}
                        fontSize={{ base: "md", md: "md", lg: "xl", xl: "2xl" }}
                        fontWeight="bold"
                        color="#3E485D"
                        lineHeight="normal"
                        mb="10px"
                      >
                        {<Html2React html={post.title.rendered} />}
                      </Heading>
                    </Link>
                    <Text
                      color={"#3E485D"}
                      display="flex"
                      alignItems="flex-end"
                      fontSize={{ base: "md", md: "md", lg: "sm", xl: "md" }}
                    >
                      <Html2React
                        html={`${post.excerpt.rendered.substring(0, 100)}  ...`}
                      />
                    </Text>
                    <Box w="max-content">
                      <Link link={post.link}>
                        <Text color="red">
                          Read more
                          <Icon as={FaChevronRight} boxSize="2" color={"red"} />
                        </Text>
                      </Link>
                    </Box>
                  </Box>
                )
              );
            })}

            <Box display="flex">
              <VStack alignItems="normal" justifyContent={"space-between"}>
                {posts.slice(5, 8).map((post, index) => {
                  //const items = state.source[type][id];
                  const date = dayjs(post.date_gmt).format("DD MMMM YYYY");
                  return (
                    <Box
                      display={{ md: "flex" }}
                      // mb="5px "
                      alignItems="center"
                      h={"100%"}
                      key={index}
                    >
                      <Box
                        flexShrink={0}
                        width={{
                          base: "100%",
                          md: "50%",
                          lg: "50%",
                          xl: "47%",
                        }}
                        //height={"95%"}
                        borderRadius={"5px"}
                        border={"1px solid #C2C8D6"}
                      >
                        <Link link={post.link} id="img-div2nd-height">
                          {/* <ImageViewFeatured id={items.featured_media} /> */}
                          <Image src={post.fimg_url} loading="lazy" className="newhomeImage" />
                          {/* <Image src={items.yoast_head_json.og_image[0].url} alt={items.title.rendered} height="auto" width="100%" max-width="100%" max-height="100%" loading="lazy" /> */}
                        </Link>
                      </Box>
                      <Box mt={{ base: 4, md: 0 }} ml={{ md: 4 }}>
                        <Link link={post.link}>
                          <Heading
                            as="h3"
                            display="block"
                            fontSize={{
                              base: "md",
                              md: "md",
                              lg: "sm",
                              xl: "lg",
                            }}
                            color="#3E485D"
                            lineHeight="normal"
                            noOfLines={2}
                          >
                            {<Html2React html={post.title.rendered} />}
                          </Heading>
                        </Link>
                        <Box>
                          <Text
                            as="span"
                            color="#3E485D"
                            fontSize={{
                              base: "md",
                              md: "md",
                              lg: "sm",
                              xl: "md",
                            }}
                            lineHeight="normal"
                            mt="2px"
                            noOfLines={2}
                          >
                            {
                              <Html2React
                                html={`${post.excerpt.rendered.substring(
                                  0,
                                  50
                                )}  ...`}
                              />
                            }
                          </Text>
                        </Box>

                        <Flex mt="2px" alignItems="center">
                          <Box w="max-content">
                            <Link link={post.link}>
                              <Text color="red">
                                Read more.....
                                <Icon
                                  as={FaChevronRight}
                                  boxSize="2"
                                  color={"red"}
                                />
                              </Text>
                            </Link>
                          </Box>
                        </Flex>
                      </Box>
                    </Box>
                  );
                })}
              </VStack>
            </Box>
          </Grid>
          {/* view from mobile latest news */}
          {/* <Stack mx="auto !important" mt="31px !important" display={{ base: "block", md: "none" }}>
            <ViewAllMobile link="/sneaker-news" />
          </Stack> */}
        </Stack>

        <FooterComponent />
      </Stack>

      <Box h={100} background="#F3F4F7"></Box>
    </>
  );
}

export default connect(Home);
