import React, { useState, useEffect, createContext, useContext, useRef } from "react";
import {
  Box,
  Flex,
  Text,
  IconButton,
  Button,
  Stack,
  Collapse,
  Icon,
  Popover,
  PopoverTrigger,
  PopoverContent,
  PopoverBody,
  useColorModeValue,
  useBreakpointValue,
  useDisclosure,
  Input,
  Img,
  extendTheme,
  InputGroup,
  InputLeftElement,
  Menu,
  MenuButton,
  Grid,
  Modal,
  ModalHeader,
  ModalOverlay,
  ModalContent,
  ModalCloseButton,
  ModalBody,
  Wrap,
  WrapItem,
  Image,
  InputRightElement,
  Drawer,
  DrawerBody,
  DrawerFooter,
  DrawerHeader,
  DrawerOverlay,
  DrawerContent,
  DrawerCloseButton,
  Heading,
  SimpleGrid,
  ListItem,
  UnorderedList,
  ChakraProvider,
  Container,
  //Link
} from "@chakra-ui/react";
import { FaUser, FaSearch } from "react-icons/fa";
import { Center, HStack } from "@chakra-ui/layout";
import {
  HamburgerIcon,
  CloseIcon,
  ChevronDownIcon,
  ChevronRightIcon,
} from "@chakra-ui/icons";
import { loadable } from "frontity";
import Link from "@frontity/components/link";
import Logo from "../images/logo.png";
//import MobileMultiMenus from "../component/Mobile-Multi-Menu";
//import DeskMultiMenus from "../component/Desk-Multi-Menu";
import connect from "@frontity/connect";
//import MobileSearchModel from "../component/MobileSearchModel";
import { SubMenu } from "../model/SubMenu";


const MobileMultiMenus = loadable(() => import('../component/Mobile-Multi-Menu'))
const DeskMultiMenus = loadable(() => import('../component/Desk-Multi-Menu'))
const MobileSearchModel = loadable(() => import('../component/MobileSearchModel'))

const Header = ({ state, libraries, actions }) => {
  const algoliaFilterData = [];
  const algoliaRelatedData = [];
  const parse = libraries.source.parse(state.router.link);
  const searchQuery = parse.query["s"];

  //const { isOpen, onToggle } = useDisclosure();
  const {
    isOpen: isOpenReportModal,
    onOpen: onOpenReportModal,
    onClose: onCloseReportModal,
  } = useDisclosure();

  const {
    isOpen: isOpenModal,
    onOpen: onOpenModal,
    onClose: onCloseModal,
  } = useDisclosure();

  const {
    isOpen: isOpendrawer,
    onOpen: onOpendrawer,
    onClose: onClosedrawer,
  } = useDisclosure();

  const firstField = React.useRef();
  const [inputValue, setinputValue] = useState("");
  const [showValue, setshowValue] = useState("Search here");
  const [headerValue, setheaderValue] = useState(" ");

  const [algoliaAlldata, setalgoliaAlldata] = useState([]);
  const [algoliaRelatedSearchdata, setalgoliaRelatedSearchdata] = useState([]);
  const [openDiv, setOpenDiv] = useState("close");
  const { isOpen, onOpen, onClose } = useDisclosure()

  // var inputValue = "";
  const [dataLoaded, setDataLoaded] = useState(false);

  // useEffect(() => {
  //   // fetchData();
  // }, [dataLoaded]); //update by Santosh

  // const fetchData = async () => {
  //   const response = await libraries.source.api.get({
  //     endpoint: `/wl/v1/menu-items`,
  //   });

  //   const postData = await response.json();
  //   actions.headerMenu.toggleLoading();
  //   actions.headerMenu.updatePostData(postData);

  //   setheaderValue(state.headerMenu.postData);
  //   console.log("header menu", headerValue);
  // };

  const brandList = [
    "nike",
    "puma",
    "adidas",
    "campus",
    "jordan",
    "asics",
    "rebok",
    "convoy",
    "Adida Trainer",
  ];
  const brandListSubItems = [
    "nike",
    "puma",
    "adidas",
    "campus",
    "jordan",
    "asics",
    "rebok",
    "convoy",
    "Adida Trainer",
  ];
  // const searchSlug = `/searchresult-for/${inputValue}`;
  // console.log("heademenuval", menus[2]);

  const handleSubmit = (event) => {
    event.preventDefault();

    // Get the input's value
    const searchString = inputValue.trim();
    // inputRef.current.value;
    //aureate_console.log("checksearch=", searchString);

    // If the typed search string is not empty
    // Better to trim write spaces as well
    if (searchString.trim().length > 0) {
      // Let's go search for blogs that match the search string

      let finalString = searchString.split(" ").join("+");
      actions.router.set(`/?s=${finalString.toLowerCase()}`);
      // inputRef.current.value = "";
      setinputValue("");
      setshowValue("Search here");

      // Scroll the page to the top
      window.scrollTo(0, 0);

      // Close the search modal
      // closeSearchModal();
    }
  };

  const algolidaData = async (event) => {
    //console.log('event', event);
    const algoliasearch = require("algoliasearch");
    // const client = algoliasearch('YZTG39ONR6', 'b2f2580375535fe8b3bd2b978582358b');
    // const POST_SNEAKER = client.initIndex('wp_posts_sneaker');
    // const RELATED_SNEAKER = client.initIndex('wp_posts_sneaker_query_suggestions');
    const client = algoliasearch('UX5RAU9WII', 'd9a2fd56e210efc671dc150c23a1db68');
    const POST_SNEAKER = client.initIndex('wp_posts_sneaker');
    const RELATED_SNEAKER = client.initIndex('wp_posts_sneaker_query_suggestions');
    await POST_SNEAKER
      .search(event)
      .then(({ hits }) => {
        hits.map(item => {
          const data = {
            title: item.post_title,
            price: item._sf_price,
            image: item?.images?.medium?.url,
            st_stts: item?.taxonomies?.status[0],
            st_links: item.permalink,
          }
          algoliaFilterData.push(data);
          setalgoliaAlldata(algoliaFilterData);
        })
      })
      .catch(err => {
        console.log(err);
      });

    // related search data
    await RELATED_SNEAKER
      .search(event)
      .then(({ hits }) => {
        hits.map(item => {
          const data = {
            title: item.objectID,
          }
          algoliaRelatedData.push(data);
          setalgoliaRelatedSearchdata(algoliaRelatedData);
        })
      })
      .catch(err => {
        console.log(err);
      });
  }
  //console.log('22222',algoliaFilterData)
  const setActiveOpen = () => {
    setOpenDiv("open");
    document.body.style.overflow = "hidden";
  }
  const closePopup = () => {
    setOpenDiv("close");
    document.body.style.overflow = "unset";
  }

  const handleKeyDown = (e) => {
    if (e.key === 'Enter') {
      setOpenDiv("close")
      closePopup()
      //e.target.blur();
    }
  }

  const setItemTitleToInput = (event) => {
    //console.log('title::: ', event.target.outerText)
    setinputValue(event.target.outerText)
    algolidaData(event.target.outerText)
  }

  useEffect(() => {
    fetchData();
    setDataLoaded(true);
  }, [dataLoaded]); //update by santosh

  const fetchData = async () => {
    const response = await libraries.source.api.get({
      endpoint: "/wl/v1/on-focus",
    });
    const categoryTabPostData = await response.json();
  };

  // levele wise menu code
  const itemsMenu = SubMenu.items;
  // state.source.get(`/menu/${state.theme.menuUrl}/`).items;
  const menuReleaseDate = [];
  itemsMenu.map((item) => {
    if (item.ID === 27490 && item.post_name === "brands") {
      menuReleaseDate.push(item.child_items);
    } 0
  });
  // console.log("items data menu = ", menuReleaseDate);

  var i = 0;
  var perentMenu = [];
  menuReleaseDate &&
    menuReleaseDate[0].map((data) => {
      var termId = data.ID;
      var slug = data.url;
      var name = data.title;
      if (data.child_items !== undefined) {
        var j = 0;
        var subMenu = [];
        data.child_items.map((item) => {
          var cId = item.ID;
          var cname = item.title;
          var cslug = item.url;

          if (item.child_items !== undefined) {
            var subMenuTemp = [];
            var k = 0;
            item.child_items.map((citems) => {
              var ccId = citems.ID;
              var ccname = citems.title;
              var ccslug = citems.url;
              subMenuTemp[k] = {
                label: ccname,
                href: ccslug,
              };

              k++;
            });

            subMenu[j] = {
              label: cname,
              href: cslug,
              submenu: subMenuTemp,
            };
          } else {
            subMenu[j] = {
              label: cname,
              href: cslug,
            };
          }

          j++;
        });

        var tempArr = {
          label: name,
          href: slug,
          submenu: subMenu,
        };
      } else {
        var tempArr = {
          label: name,
          href: slug,
        };
      }

      perentMenu.push(tempArr);
      i++;
    });

  menus[1].submenu = perentMenu;
  //aureate_console.log("menu data :", menus[2]);

  return (
    <Box
      id="sticky-header"
      px={{ base: "6", md: "16", lg: "40" }}
      boxShadow={{ base: "lg", md: "none" }}
    >
      <Flex
        color={useColorModeValue("black", "black")}
        minH={"60px"}
        py={{ base: 2 }}
        px={{ base: 4 }}
        align={"center"}
        className="mobile_head"
      >
        <Flex
          flex={{ base: 1, md: "auto" }}
          ml={{ base: -2 }}
          display={{ base: "flex", md: "none" }}
          // style={{ flex: 'unset' }}
        >
          <IconButton
            onClick={!isOpendrawer ? onOpendrawer : onClosedrawer}
            icon={
              isOpendrawer ? (
                <CloseIcon w={3} h={3} />
              ) : (
                <HamburgerIcon w={5} h={5} />
              )
            }
            variant={"ghost"}
            aria-label={"Toggle Navigation"}
          />
        </Flex>
        <Flex flex={{ base: 1 }} justify={{ base: "center", md: "start" }} className="logo">
          <Text
            textAlign={useBreakpointValue({ base: "center", md: "left" })}
            fontFamily={"heading"}
            color={useColorModeValue("gray.800", "white")}
          >

            <Link
              link="/"
              onClick={closePopup}
            // _focus={{ boxShadow: "none" }}
            // display={{ base: "block", md: "inline-flex" }}
            >
              <Image
                // boxSize="50px"
                objectFit="contain"
                //src={`/static/${Logo}`}
                src={Logo}
                width="100% !important"
                height="30px !important"
                alt={state.frontity.company_name + " Home LOGO"}
              />
            </Link>
          </Text>
        </Flex>

        <Stack
          flex={{ base: 1, md: 0 }}
          justify={"flex-end"}
          direction={"row"}
          spacing={6}
          className="search-box-top"
        >
          <HStack spacing="15" style={{
            height: '100%',
            margin: 0,
            marginLeft: '20px',
            borderRadius: 0
          }}>
            <Box
              bg="#F3F4F7"
              width="max-content"
              m={3}
              h="auto"
              borderRadius="lg"
              //display={{ md: "flex", base: "none" }}
              display={{ md: "flex" }}
              className="search__box_inner"
            >
              <InputGroup justifyContent="center" textAlign="center">
                <Center>
                  <Menu>
                    {/* <MenuButton
                      w="32"
                      fontSize="xs"
                      fontFamily="Open Sans"
                      onClick={onOpenReportModal}
                    >
                      All Brands <ChevronDownIcon />
                    </MenuButton> */}

                    {/* <Modal
                      closeOnOverlayClick={false}
                      isOpen={isOpenReportModal}
                      onClose={onCloseReportModal}
                      size="5xl"
                    >
                      <ModalOverlay />
                      <ModalContent>
                        <ModalCloseButton />
                        <ModalBody py={12}>
                          <InputGroup
                            //display={{ base: "block", md: "none" }}
                            display={{ base: "block", md: "block" }}
                            color="#9DA7BE"
                            bg="#F2F2F2"
                          >
                            <InputRightElement
                              pointerEvents="visibleFill"
                              children={
                                // <Link link={searchSlug}>
                                <FaSearch
                                  onClick={(e) => handleSubmit(e)}
                                  color="#3E485D"
                                />
                                // </Link>
                                // <FaSearch color="#3E485D" />
                              }
                            />
                            <Input
                              //id="input"
                              type="text"
                              placeholder={showValue}
                              value={inputValue}
                              onChange={(event) => {
                                event.preventDefault();
                                setshowValue(event.target.value);
                                setinputValue(event.target.value);
                              }}
                              minW="100%"
                              w="auto"
                              fontSize="xs"
                              color="#9DA7BE"
                              className="search__inputb"
                            />
                          </InputGroup>
                          <HStack
                            flexDirection={{ base: "column", md: "row" }}
                            alignItems={{
                              base: "flex-start",
                              md: "baseline",
                            }}
                            mt={4}
                          >
                            <Text
                              color="#666666"
                              fontWeight="bold"
                              fontSize="sm"
                              mr={5}
                              mb={2}
                            >
                              Related Search...
                            </Text>
                            <Wrap direction="row" ml="0px !important">
                              {brandList.map((data, index) => {
                                return (
                                  <WrapItem key={"Headersk1-" + index}>
                                    <Center
                                      onClick={() => {
                                        // onToggle;
                                        onCloseReportModal();
                                        setshowValue(data);
                                        setinputValue(data);
                                      }}
                                      bg="#F3F4F7"
                                      color="#666666"
                                      fontSize="sm"
                                      px={2}
                                      py={1}
                                      borderRadius="md"
                                    >
                                      {data}
                                    </Center>
                                  </WrapItem>
                                );
                              })}
                            </Wrap>
                          </HStack>
                        </ModalBody>
                      </ModalContent>
                    </Modal> */}
                  </Menu>
                </Center>
                {/* <Box
                  bg="#CDCDCD"
                  width="0px"
                  h="30px"
                  alignSelf="center"
                  mr="4"
                /> */}

                <form className="search__form_main" onSubmit={handleSubmit}>
                  <Box className="search__wrap search-top">
                    <Icon
                      as={FaSearch}
                      boxSize="5"
                      color={"black"}
                      className="search__icon"
                    />
                    <input
                      type="text"
                      fontFamily="Open Sans"
                      border="unset"
                      fontSize="xs"
                      color="#9DA7BE"
                      placeholder={showValue}
                      value={inputValue}
                      onFocus={(event) => {
                        setActiveOpen()
                      }}
                      className="search_input"
                      onChange={(event) => {
                        event.preventDefault();
                        algolidaData(event.target.value)
                        setshowValue(event.target.value)
                        setinputValue(event.target.value)
                      }}
                      onKeyDown={handleKeyDown}
                      variant="unstyled"
                      w={{ md: "50", lg: "60" }}
                    />
                    <Center className="subbtn">
                      <Button
                        type="submit"
                        display={{ base: "none", md: "block" }}
                        onClick={(e) => handleSubmit(e)}
                        bg="#3E485D"
                        colorScheme="#3E485D"
                        color="#FFFFFF"
                        variant="solid"
                        h="50"
                        w="32"
                        _focus={"outline:none;"}
                        className="search_submit_btn"
                        onFocus={(event) => {
                          closePopup()
                        }}
                      >
                        <Text fontWeight="500" fontSize="xs">
                          Find Item
                        </Text>
                      </Button>
                    </Center>
                    {/* <h1>Popup/Modal Windows without JavaScript</h1> */}

                  </Box>

                  <div id="popup1" class={`overlay search__form_main_popup popup-box search__form_main ${openDiv === "open" ? 'active' : ''}`}>
                    <div class="popup search__wrap">
                      <a class="close background_close" href="javascript:void(0);" onClick={closePopup}></a>
                      <a class="close" href="javascript:void(0);" onClick={closePopup}>&times;</a>
                      <div class="content">
                        <div className="search-panel__content">
                          <div className="modal-box">

                            {/* <ModalOverlay className="search__overlay_content" onClose={onClose}/> */}

                            <Box className="search__wrap searchtop">
                              <Icon
                                as={FaSearch}
                                boxSize="5"
                                color={"black"}
                                className="search__icon"
                              />
                              <input
                                type="text"
                                fontFamily="Open Sans"
                                border="unset"
                                fontSize="xs"
                                color="#9DA7BE"
                                placeholder={showValue}
                                value={inputValue}
                                onFocus={(event) => {
                                  setActiveOpen()
                                }}
                                className="search_input"
                                onChange={(event) => {
                                  event.preventDefault();
                                  algolidaData(event.target.value)
                                  setshowValue(event.target.value)
                                  setinputValue(event.target.value)
                                }}
                                onKeyDown={handleKeyDown}
                                variant="unstyled"
                                w={{ md: "50", lg: "60" }}
                              />
                              <Center>
                                <Button
                                  type="submit"
                                  display={{ base: "none", md: "block" }}
                                  onClick={(e) => handleSubmit(e)}
                                  bg="#3E485D"
                                  colorScheme="#3E485D"
                                  color="#FFFFFF"
                                  variant="solid"
                                  h="50"
                                  w="32"
                                  _focus={"outline:none;"}
                                  className="search_submit_btn"
                                  onFocus={(event) => {
                                    closePopup()
                                  }}
                                >
                                  <Text fontWeight="500" fontSize="xs">
                                    Find Item
                                  </Text>
                                </Button>
                              </Center>
                              {/* <h1>Popup/Modal Windows without JavaScript</h1> */}

                            </Box>

                            <div className="aux">
                              <UnorderedList className="search-panel__suggestions" pt={[25, 30]}>
                                <Box w="100%">
                                  <span className="search-panel__suggestions-message">Related searches</span>
                                </Box>
                                {
                                  algoliaRelatedSearchdata.length > 0 ?
                                    (algoliaRelatedSearchdata.slice(0, 10)).map((item, index) => {
                                      return (<ListItem key={index} className="btn btn--tag btn--dark"> <span onClick={(e) => setItemTitleToInput(e)}>{item.title} </span></ListItem>)
                                    })
                                    :
                                    (
                                      <>
                                        <ListItem className="btn btn--tag btn--dark"><span onClick={(e) => setItemTitleToInput(e)}>nike air</span></ListItem>
                                        <ListItem className="btn btn--tag btn--dark"><span onClick={(e) => setItemTitleToInput(e)}>jordan</span></ListItem>
                                        <ListItem className="btn btn--tag btn--dark"><span onClick={(e) => setItemTitleToInput(e)}>air force</span></ListItem>
                                        <ListItem className="btn btn--tag btn--dark"><span onClick={(e) => setItemTitleToInput(e)}>acronym</span></ListItem>
                                        <ListItem className="btn btn--tag btn--dark"><span onClick={(e) => setItemTitleToInput(e)}>asics</span></ListItem>
                                        <ListItem className="btn btn--tag btn--dark"><span onClick={(e) => setItemTitleToInput(e)}>triple</span></ListItem>
                                        <ListItem className="btn btn--tag btn--dark"><span onClick={(e) => setItemTitleToInput(e)}>reebok</span></ListItem>
                                        <ListItem className="btn btn--tag btn--dark"><span onClick={(e) => setItemTitleToInput(e)}>womens</span></ListItem>
                                      </>
                                    )
                                }

                              </UnorderedList>


                              <Box spacing={10}>
                                <Box>
                                  <span className="search_result_name_with_count">
                                    {inputValue.trim().length !== 0 ? `"${inputValue}" results about ${algoliaAlldata.length}` : null}
                                  </span>
                                </Box>
                                <Box className="relatedSearchData">
                                  {openDiv === 'open' && algoliaAlldata.length > 0 ?
                                    (algoliaAlldata.slice(0, 15)).map((item, index) => {
                                      console.log("rrrrrr", item)
                                      return (
                                        <Box spacing='40px' key={index} style={{ display: "block" }} className="search_pro_wrap">
                                          <Box className="search_mainCol" onClick={closePopup}>
                                            <Box className="search_imageWrapper">
                                              <Link link={item.st_links} onClick={closePopup}>
                                                <Box className="search_pro_image">
                                                  <Image
                                                    src={item.image}
                                                    alt={item.title}
                                                    className="search_image" />
                                                </Box>
                                                <Box className="contentRight">
                                                  <Text className="search_pro_title">{item.title}</Text>
                                                  <Text className="search_pro_price">£{item.price}</Text>
                                                  <Text className="search_pro_title">
                                                    {item.st_stts == "Coming Soon 2022" ? <p className="chakra_text_soon"><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" focusable="false" class="chakra-icon css-1v3jx3o e1k4it830" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M256,8C119,8,8,119,8,256S119,504,256,504,504,393,504,256,393,8,256,8Zm92.49,313h0l-20,25a16,16,0,0,1-22.49,2.5h0l-67-49.72a40,40,0,0,1-15-31.23V112a16,16,0,0,1,16-16h32a16,16,0,0,1,16,16V256l58,42.5A16,16,0,0,1,348.49,321Z"></path></svg><span>Coming Soon 2022</span></p> :
                                                      item.st_stts == "In stock" ? <p className="chakra_text_stock"><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" focusable="false" class="chakra-icon css-2iiqxo e1k4it830" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z"></path></svg><span>In Stock</span></p> :
                                                        item.st_stts == "Sold Out" ? <p className="chakra_text_soon"><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" focusable="false" class="chakra-icon css-1v3jx3o e1k4it830" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M256,8C119,8,8,119,8,256S119,504,256,504,504,393,504,256,393,8,256,8Zm92.49,313h0l-20,25a16,16,0,0,1-22.49,2.5h0l-67-49.72a40,40,0,0,1-15-31.23V112a16,16,0,0,1,16-16h32a16,16,0,0,1,16,16V256l58,42.5A16,16,0,0,1,348.49,321Z"></path></svg><span>Sold Out</span></p> : null}
                                                  </Text>
                                                </Box>
                                              </Link>
                                            </Box>
                                          </Box>
                                        </Box>
                                      )
                                    })
                                    :
                                    (state.onFocus.postData.slice(0, 15)).map((item, index) => {
                                      return (
                                        <Box spacing='40px' key={index} style={{ display: "block" }} className="search_pro_wrap">
                                          <Box className="search_mainCol" onClick={closePopup}>
                                            <Box className="search_imageWrapper">
                                              <Link link={item.slug} className="search_imageWrapper" onClick={closePopup}>
                                                <Box className="search_pro_image">
                                                  <Image
                                                    src={item?.featured_image?.medium}
                                                    className="search_image"
                                                    alt={item.title} />
                                                </Box>
                                                <div className="contentRight">
                                                  <Text className="search_pro_title">{item.post_title}</Text>
                                                  <Text className="search_pro_price">£{item.price}</Text>
                                                  <Text className="search_pro_title">
                                                    {item.sneaker_status == "instock" ? <p className="chakra_text_stock"><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" focusable="false" class="chakra-icon css-2iiqxo e1k4it830" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z"></path></svg><span>In Stock</span></p> : null}
                                                  </Text>
                                                </div>
                                              </Link>
                                            </Box>
                                          </Box>
                                        </Box>
                                      )
                                    })
                                  }
                                </Box>
                              </Box>

                              {inputValue.trim().length !== 0 ?
                                <Box style={{ textAlign: "center" }}>
                                  <Link onClick={(e) => handleSubmit(e)}>
                                    <Button variant='outline' onClick={closePopup} className="search_viewmore_btn">View More</Button>
                                  </Link>
                                </Box> :
                                <Box style={{ textAlign: "center" }}>
                                  <Link link="/">
                                    <Button variant='outline' onClick={closePopup} className="search_viewmore_btn">View More</Button>
                                  </Link>
                                </Box>
                              }
                            </div>


                          </div>
                        </div>
                      </div>
                    </div>
                  </div>


                  {/* </Link> */}

                </form>
              </InputGroup>
              {/* <Button onClick={onOpen}>Open Modal</Button> */}
            </Box>

            {/* <Text
              _focus={{ boxShadow: "none" }}
              display={{ base: "block", md: "none" }}
            >
              <Icon
                as={FaSearch}
                boxSize="5"
                color={"black"}
                onClick={onOpenModal}
              />
              <MobileSearchModel
                onCloseModal={onCloseModal}
                isOpenModal={isOpenModal}
              // handleSubmit={(e) => handleSubmit(e)}
              />
            </Text> */}
          </HStack>
        </Stack>
      </Flex>

      <Box className="search-panel__content">
        <ChakraProvider className="modal-box">
          <Modal isOpen={isOpen} size="full" onClose={onClose}>
            {/* <ModalOverlay className="search__overlay_content" onClose={onClose}/> */}
            <ModalCloseButton mb={[20, 20]} className="search__closeBtn1" />
            <ModalContent borderTopRadius="0" border='1px' borderStyle='solid' borderColor='gray.200'>
              <ModalCloseButton mb={[20, 20]} className="search__closeBtn" />
              <ModalBody className="aux">
                <UnorderedList className="search-panel__suggestions" pt={[25, 30]}>
                  <Box w="100%">

                    <span className="search-panel__suggestions-message">Related searches</span>
                  </Box>
                  {
                    algoliaRelatedSearchdata.length > 0 ?
                      algoliaRelatedSearchdata.map((item, index) => {
                        return (<ListItem key={index} onClick={item.title} className="btn btn--tag btn--dark"> {item.title} </ListItem>)
                      })
                      : ''
                  }
                </UnorderedList>
                <Box spacing={10}>
                  <Box className="relatedSearchData">
                    {openDiv === 'open' && algoliaAlldata.length > 0 ?
                      (algoliaAlldata.slice(0, 12)).map((item, index) => {
                        return (
                          <Box spacing='40px' key={index} style={{ display: "block" }} className="search_pro_wrap">
                            <Box className="search_mainCol">
                              <Box className="search_imageWrapper">
                                <Link link={item.st_links} onClick={onClose}>
                                  <Image
                                    src={item.image}
                                    alt={item.title}
                                    className="search_image" />
                                  <Box className="contentRight">
                                    <Text className="search_pro_title">{item.title}</Text>
                                    <Text className="search_pro_title">
                                      {item.st_stts == "Coming Soon 2022" ? <p className="chakra_text_soon"><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" focusable="false" class="chakra-icon css-1v3jx3o e1k4it830" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M256,8C119,8,8,119,8,256S119,504,256,504,504,393,504,256,393,8,256,8Zm92.49,313h0l-20,25a16,16,0,0,1-22.49,2.5h0l-67-49.72a40,40,0,0,1-15-31.23V112a16,16,0,0,1,16-16h32a16,16,0,0,1,16,16V256l58,42.5A16,16,0,0,1,348.49,321Z"></path></svg><span>Coming Soon 2022</span></p> :
                                        item.st_stts == "In stock" ? <p className="chakra_text_stock"><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" focusable="false" class="chakra-icon css-2iiqxo e1k4it830" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z"></path></svg><span>In Stock</span></p> :
                                          item.st_stts == "Sold Out" ? <p className="chakra_text_soon"><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" focusable="false" class="chakra-icon css-1v3jx3o e1k4it830" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M256,8C119,8,8,119,8,256S119,504,256,504,504,393,504,256,393,8,256,8Zm92.49,313h0l-20,25a16,16,0,0,1-22.49,2.5h0l-67-49.72a40,40,0,0,1-15-31.23V112a16,16,0,0,1,16-16h32a16,16,0,0,1,16,16V256l58,42.5A16,16,0,0,1,348.49,321Z"></path></svg><span>Sold Out</span></p> : null}
                                    </Text>
                                  </Box>
                                </Link>
                              </Box>
                            </Box>
                          </Box>
                        )
                      })
                      :
                      (state.onFocus.postData.slice(0, 12)).map((item, index) => {
                        return (
                          <Box spacing='40px' key={index} style={{ display: "block" }} className="search_pro_wrap">
                            <Box className="search_mainCol" onClose={onClose}>
                              <Box className="search_imageWrapper">
                                <Link link={item.slug} className="search_imageWrapper" onClick={onClose}>
                                  <Image
                                    src={item?.featured_image?.large}
                                    className="search_image"
                                    alt={item.title} />
                                  <div className="contentRight">
                                    <Text className="search_pro_title">{item.post_title}</Text>
                                    <Text className="search_pro_title">
                                      {item.sneaker_status == "instock" ? <p className="chakra_text_stock"><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" focusable="false" class="chakra-icon css-2iiqxo e1k4it830" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z"></path></svg><span>In Stock</span></p> : null}
                                    </Text>
                                  </div>
                                </Link>
                              </Box>
                            </Box>
                          </Box>
                        )
                      })
                    }
                  </Box>
                </Box>

                <Box style={{ textAlign: "center" }}><Link onClick={(e) => handleSubmit(e)}><Button variant='outline' onClick={closePopup} className="search_viewmore_btn">View More</Button></Link></Box>
              </ModalBody>
            </ModalContent>
          </Modal>
        </ChakraProvider>
      </Box>


      <Flex
        my={8}
        display={{ base: "none", md: "flex" }}
        justifyContent="space-around"
      >
        <DeskMultiMenus menus={menus} />
        {/* <DesktopNav /> */}
      </Flex>

      <Collapse in={isOpen} animateOpacity>
        <MobileNav
          isOpendrawer={isOpendrawer}
          onClosedrawer={onClosedrawer}
          onToggleDrawer
        />
      </Collapse>
      {/* <div className="searchDataWrapper">
        <span className="closeIcon" onClick={closePopup}> Close </span>
        <div className="relatedSearchData">
          <UnorderedList>
            {
              algoliaRelatedSearchdata.length > 0 ?
                algoliaRelatedSearchdata.map((item, index) => {
                  return (<ListItem key={index}> {item.title} </ListItem>);
                })
                : ''
            }
          </UnorderedList>
        </div>
        {openDiv === 'open' && algoliaAlldata.length > 0 ?
          (algoliaAlldata.slice(0, 15)).map((item, index) => {
            return (
              <SimpleGrid columns={[2, null, 3]} spacing='40px' key={index}>
                <Box>
                  <div className="imageWrapper">
                    <Image
                      boxSize='100px'
                      objectFit='cover'
                      src={item.image}
                      alt='Dan Abramov' />
                  </div>
                  <div className="contentRight">
                    <h3>{item.title}</h3>
                    <p>$30.00</p>
                  </div>
                </Box>
              </SimpleGrid>
            )
          })
          :
          (state.onFocus.postData).map((item, index) => {
            return (
              <SimpleGrid columns={[2, null, 3]} spacing='40px' key={index}>
                <Box>
                  <div className="imageWrapper">
                    <Image
                      boxSize='100px'
                      objectFit='cover'
                      src={item?.featured_image?.thumbnail}
                      alt='Dan Abramov' />
                  </div>
                  <div className="contentRight">
                    <h3>{item.post_title}</h3>
                    <p>${item.price}</p>
                  </div>
                </Box>
              </SimpleGrid>
            )
          })
        }
        <Button colorScheme='teal' size='md'>
          View All
        </Button>
      </div> */}
    </Box>
  );
};

export default connect(Header);
export const DrawerToggle = React.createContext();

export const MobileNav = ({
  isOpendrawer,
  onClosedrawer,
  onToggleDrawer,
  state,
}) => {
  var data = "oka";

  return (
    <DrawerToggle.Provider value={onClosedrawer}>
      <Drawer
        placement="left"
        isOpen={isOpendrawer}
        onClose={onClosedrawer}
        w="200px"
      >
        <DrawerOverlay />
        <DrawerContent>
          <DrawerCloseButton />
          <DrawerHeader borderBottomWidth="1px">Fastsole Menu</DrawerHeader>

          <DrawerBody>
            <Stack
              bg={useColorModeValue("white", "gray.800")}
              p={4}
              display={{ md: "none" }}
            >
              <MobileMultiMenus menus={menus} />
            </Stack>
          </DrawerBody>
        </DrawerContent>
      </Drawer>
    </DrawerToggle.Provider>
  );
};

const menus = [
  {
    label: "Home",
    href: "/",
  },

  {
    label: "Release Dates",
    href: "/sneaker-release-dates/",
    submenu: [],
    // [
    // {
    //   label: "Sub Menu 1",
    //   href: "/submenu1",
    //   submenu: [
    //     {
    //       label: "Boom 1",
    //       href: "/boom1",
    //     },
    //     {
    //       label: "Boom 2",
    //       href: "/boom2",
    //     },
    //   ],
    // },
    // {
    //   label: "Sub Menu 2",
    //   href: "/submenu2",
    //   submenu: [
    //     {
    //       label: "Deep 1",
    //       href: "/deep1",
    //     },
    //     {
    //       label: "Deep 2",
    //       href: "/deep2",
    //       // submenu: [
    //       //   {
    //       //     label: "Lorem 1",
    //       //     href: '#',
    //       //   },
    //       //   {
    //       //     label: "Lorem 2",
    //       //     href: '#',
    //       //     submenu: [
    //       //       {
    //       //         label: "Super Deep",
    //       //         href: '#',
    //       //       }
    //       //     ]
    //       //   }
    //       // ]
    //     },
    //   ],
    // },
    // {
    //   label: "Sub Menu 3",
    //   href: "/submneu3",
    // },
    // {
    //   label: "Sub Menu 4",
    //   href: "sybmenu4",
    //   submenu: [
    //     {
    //       label: "Last 1",
    //       href: "/last1",
    //     },
    //     {
    //       label: "Last 2",
    //       href: "/last2",
    //     },
    //     {
    //       label: "Last 3",
    //       href: "/last3",
    //     },
    //   ],
    // },
    // ],
  },
  // {
  //   label: "Product",
  //   href: "/product-salepage/",
  // },
  {
    label: "News",
    href: "/sneaker-news",
  },
  {
    label: "About us",
    href: "/about/",
    // submenu: [
    //   {
    //     label: "About us",
    //     href: "#",
    //   },
    //   {
    //     label: "About us",
    //     href: "#",
    //   }
    // ]
  },
  {
    label: "Offer & Discount",
    href: "/sneaker-news/category/offer-discount",
  },
  {
    label: "Contact us",
    href: "/contact",
  },
];