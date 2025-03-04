import React, { useEffect, useState } from "react";
import {
  Box,
  Flex,
  Grid,
  Stack,
  Text,
  VStack,
  Circle,
} from "@chakra-ui/layout";
import {
  Heading,
  WrapItem,
  Center,
  HStack,
  Wrap,
  Button,
  Select,
  Drawer,
  DrawerBody,
  DrawerFooter,
  DrawerHeader,
  DrawerOverlay,
  DrawerContent,
  DrawerCloseButton,
  Image,
  Icon,
  Input,
  RadioGroup,
  useDisclosure,
  Radio,
  RangeSlider,
  RangeSliderTrack,
  RangeSliderFilledTrack,
  RangeSliderThumb,
  InputGroup,
  Modal,
  ModalOverlay,
  ModalHeader,
  ModalCloseButton,
  ModalBody,
  ModalContent,
  ModalFooter,
  InputRightElement,
  GridItem
} from "@chakra-ui/react";
import {
  FaAngleDoubleLeft,
  FaChevronRight,
  FaAngleDoubleRight,
  FaChevronLeft,
  FaCheckCircle,
  FaChevronDown,
  FaCircle,
  FaSlidersH,
  FaUndo,
  FaClock,
} from "react-icons/fa";
// import Filtermobile from "../component/Filtermobile";
import Link from "@frontity/components/link";
import connect from "@frontity/connect";
import { ArrowDownIcon } from "@chakra-ui/icons";
import { DateRangePicker } from "react-date-range";
import { addDays, parse } from "date-fns";
import { MdDateRange } from "react-icons/md";
import Productskeleton from "./Productskeleton";
import NoProduct from "./NoProduct";
import algoliasearch from 'algoliasearch'
import {
  InstantSearch,
  Menu,
  Hits,
  SearchBox,
  Pagination,
  HitsPerPage,
  ClearRefinements,
  RefinementList,
  Configure,
} from 'react-instantsearch-dom';

const searchClient = algoliasearch("PXZ8QSDLQ2", "3e496007e6ede6216f85bb6ceed9ed47")

const Hit = (props) => {

  const date = new Date(props.hit.post_date * 1000).toGMTString();
  const dateString = date.split(' ').slice(0, 4).join(' ');

  return (
    <div className='grid-items'>
      <div className='profile'>
        <div className='img-container'>
          <div className="search-image">
            <a href={props.hit.permalink}>
              <img src={props.hit.images.medium.url} width="259" height="166" align="left" alt={props.hit.post_title} />
            </a>
          </div>
        </div>
        <div className='search-sub-wrapper'>
          <div className="hit-name"><a href={props.hit.permalink}>{props.hit.post_title}</a></div>
          <div className="price_status">
            <div className="hit-price">£{props.hit._sf_price}</div>
            <Text className="search_pro_titleee">
              {props.hit.taxonomies.status[0] == 'In stock' ? <div className="hit-status"><p className="chakra_text_stock searchpageIcon"><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" focusable="false" class="chakra-icon css-2iiqxo e1k4it830" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z"></path></svg><span>{props.hit.taxonomies.status[0]}</span></p></div> :
                props.hit.taxonomies.status[0] == 'On Focus' ? <div className="hit-status"><p className="chakra_text_stock searchpageIcon"><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" focusable="false" class="chakra-icon css-2iiqxo e1k4it830" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z"></path></svg><span>On Focus</span></p></div> :
                  props.hit.taxonomies.status[0] == 'Coming Soon 2022' ? <div className="hit-status"><p className="chakra_text_soon searchpageIcon"><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" focusable="false" class="chakra-icon css-1v3jx3o e1k4it830" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M256,8C119,8,8,119,8,256S119,504,256,504,504,393,504,256,393,8,256,8Zm92.49,313h0l-20,25a16,16,0,0,1-22.49,2.5h0l-67-49.72a40,40,0,0,1-15-31.23V112a16,16,0,0,1,16-16h32a16,16,0,0,1,16,16V256l58,42.5A16,16,0,0,1,348.49,321Z"></path></svg><span>Coming Soon</span></p></div> :
                    props.hit.taxonomies.status[0] == 'Sold Out' ? <div className="hit-status"><p className="chakra_text_soon searchpageIcon"><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 512 512" focusable="false" class="chakra-icon css-1v3jx3o e1k4it830" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M256,8C119,8,8,119,8,256S119,504,256,504,504,393,504,256,393,8,256,8Zm92.49,313h0l-20,25a16,16,0,0,1-22.49,2.5h0l-67-49.72a40,40,0,0,1-15-31.23V112a16,16,0,0,1,16-16h32a16,16,0,0,1,16,16V256l58,42.5A16,16,0,0,1,348.49,321Z"></path></svg><span>{props.hit.taxonomies.status[0]}</span></p></div> :
                      null}
            </Text>
          </div>
        </div>
        {/* <Box className="view_now_btn">
          <a href={props.hit.permalink}>
            View Now
          </a>
        </Box> */}
      </div>
    </div>
  )
}

const SearchResult = ({ state, actions, libraries, searchString, props }) => {

  const containerRef = React.useRef(null);
  const headerRef = React.useRef(null);

  function openFilters() {
    document.body.classList.add('filtering');
    window.scrollTo(0, 0);
    window.addEventListener('keyup', onKeyUp);
    window.addEventListener('click', onClick);
  }

  function closeFilters() {
    document.body.classList.remove('filtering');
    containerRef.current.scrollIntoView();
    window.removeEventListener('keyup', onKeyUp);
    window.removeEventListener('click', onClick);
  }

  function onKeyUp(event) {
    if (event.key !== 'Escape') {
      return;
    }

    closeFilters();
  }

  function onClick(event) {
    if (event.target !== headerRef.current) {
      return;
    }

    closeFilters();
  }


  let [countpost, setCountPost] = useState();
  const [priceRangeShow, setpriceRangeShow] = useState(false);
  const [resetClick, setresetClick] = useState(false);

  var searchdata = searchString.toLowerCase();

  const [stockValue, setStockValue] = useState({
    brandId: searchdata,
    totalProduct: 20,
    priceMin: 0,
    priceMax: 500,
    status: "instock",
    date: "",
    sortBy: "",
    color: "",
  });
  //console.log("myserachstring", searchString);

  const [priceRange, setPriceRange] = useState({ min: 0, max: 500 });
  const [dropDown, setDropdown] = useState("");

  const [filter, setFilter] = useState({
    sneaker_status: "instock",
    color: "",
    priceMin: 0,
    paricemax: 500,
  });

  const rangeSlider = (range) => {
    // console.log("rangeslider", range) range slider
    var min = range[0];
    var max = range[1];
    var temp = {
      min: min,
      max: max,
    };
    var tempArr = {
      brandId: stockValue.brandId,
      totalProduct: stockValue.totalProduct,
      priceMin: min,
      priceMax: max,
      status: stockValue.status,
      date: stockValue.date,
      sortBy: stockValue.sortBy,
      color: stockValue.color,
    };
    setStockValue(tempArr);
    setPriceRange(temp);
    setCurrentPage(1);
  };

  //console.log("stock value :", stockValue);

  const brandChange = (e) => {
    var value = parseInt(e);
    var totalProduct = stockValue.totalProduct;

    var tempArr = {
      brandId: value,
      totalProduct: totalProduct,
      priceMin: stockValue.priceMin,
      priceMax: stockValue.priceMax,
      status: stockValue.status,
      date: stockValue.date,
      sortBy: stockValue.sortBy,
      color: stockValue.color,
    };
    setStockValue(tempArr);
  };

  const { isOpen, onOpen, onClose } = useDisclosure();
  const btnRef = React.useRef();

  const totalPost = 5;
  // for choose date from calender start
  const [choosedate, setchoosedate] = useState("");

  const convertDate = (event) => {
    const tempDate = JSON.stringify(event);
    const finalDate = tempDate.slice(1, 11);
    var intDate = finalDate.split("-").join("");
    return intDate;
  };

  const exactDate = (startdate, enddate) => {
    const firstdate = convertDate(startdate);
    const secdate = convertDate(enddate);
    const comparedate = `${firstdate}-${secdate}`;
    setchoosedate(comparedate);
    setCurrentPage(1);
    console.log("finaldate", choosedate);
  };

  // end

  useEffect(() => {
    var slug = `${stockValue.brandId}-${stockValue.totalProduct}-${stockValue.priceMin}-${stockValue.priceMax}-${stockValue.status}-${stockValue.date}-${stockValue.sortBy}-${stockValue.color}-${choosedate}`;
    brandDataFetch();
    console.log("items SLUG =", slug);
    fetchData(slug);
  }, [stockValue, choosedate, searchString]);

  useEffect(() => {
    var slug = `${stockValue.brandId}-${stockValue.totalProduct}-${stockValue.priceMin}-${stockValue.priceMax}-${stockValue.status}-${stockValue.date}-${stockValue.sortBy}-${stockValue.color}-${choosedate}`;
    console.log("items SLUG =", slug);
    fetchData(slug);
  }, [searchString, choosedate]);

  const fetchData = async (slug) => {
    if (typeof searchString === "string") {
      var dataUri = `/wl/v1/search-items/${slug}`;
    } else {
      var dataUri = `/wl/v1/sneaker-release-dates-test/${slug}`;
    }

    actions.sneakerReleaseDates.notoggleLoading();
    const response = await libraries.source.api.get({
      endpoint: dataUri,
    });

    const result = await response.json();
    actions.sneakerReleaseDates.toggleLoading();
    actions.sneakerReleaseDates.updatePostData(result);

    //console.log("sneaker release date :  ", result);
  };

  var items = state.sneakerReleaseDates.postData.post;
  let totalCount = state.sneakerReleaseDates.postData.totalPost;

  // pagination component start
  var dataLimit = 12;
  if (totalCount >= 36) {
    var pageLimit = 3;
  } else if (totalCount >= 12 && totalCount < 36) {
    var pageLimit = 2;
  } else {
    var pageLimit = 1;
  }

  const [pages] = useState(Math.round(totalCount / dataLimit));
  const [currentPage, setCurrentPage] = useState(1);
  const [dataLength, setDataLength] = useState({ min: 0, max: 12 });

  const doubleRight = () => {
    setCurrentPage(pages);
  };
  const doubleLeft = () => {
    setCurrentPage(1);
  };

  function goToNextPage() {
    setCurrentPage((page) => page + 1);
  }
  function goToPreviousPage() {
    setCurrentPage((page) => page - 1);
  }

  function changePage(event) {
    const pageNumber = Number(event.target.textContent);
    setCurrentPage(pageNumber);
  }
  useEffect(() => {
    getPaginationData();
  }, [currentPage]);

  useEffect(() => {
    updateIndex();
    getPaginationGroup();
  }, [
    stockValue.brandId,
    stockValue.priceMin,
    stockValue.priceMax,
    stockValue.color,
    stockValue.status,
  ]);

  const updateIndex = async () => {
    setDataLength({ min: 0, max: 12 });
    setCurrentPage(1);
  };

  const getPaginationData = async () => {
    const startIndex = currentPage * dataLimit - dataLimit;
    const endIndex = startIndex + dataLimit;
    console.log("curret page :", startIndex, endIndex);
    const tempArr = {
      brandId: stockValue.brandId,
      totalProduct: endIndex,
      priceMin: stockValue.priceMin,
      priceMax: stockValue.priceMax,
      status: stockValue.status,
      date: stockValue.date,
      sortBy: stockValue.sortBy,
      color: stockValue.color,
    };
    setStockValue(tempArr);
    setDataLength({ min: startIndex, max: endIndex });
  };

  const getPaginationGroup = () => {
    let start = Math.floor((currentPage - 1) / pageLimit) * pageLimit;
    return new Array(pageLimit).fill().map((_, idx) => start + idx + 1);
  };
  const stockChange = (value) => {
    console.log("filter array", filter);
    var tempFilter = {
      sneaker_status: value,
      color: "",
      priceMin: 0,
      paricemax: 500,
    };
    const tempArr = {
      brandId: stockValue.brandId,
      totalProduct: stockValue.totalProduct,
      priceMin: stockValue.priceMin,
      priceMax: stockValue.priceMax,
      status: value,
      date: stockValue.date,
      sortBy: stockValue.sortBy,
      color: stockValue.color,
    };
    setStockValue(tempArr);
    setFilter(tempFilter);
  };

  var filterItems = items && items;

  // get input data from release calendar
  let shortDropDown = (value) => {
    console.log("drop down value :", value);
    setDropdown(value);

    const tempArr = {
      brandId: stockValue.brandId,
      totalProduct: stockValue.totalProduct,
      priceMin: stockValue.priceMin,
      priceMax: stockValue.priceMax,
      status: stockValue.status,
      date: stockValue.date,
      sortBy: value,
      color: stockValue.color,
    };
    setStockValue(tempArr);
  };

  const brandDataFetch = async () => {
    const response = await libraries.source.api.get({
      endpoint: `/wl/v1/footwear-brands`,
    });

    const result = await response.json();
    actions.brandsData.toggleLoading();
    actions.brandsData.updatePostData(result);
  };

  const brandData = state.brandsData.postData;
  const data = state.sneakerReleaseDates.postData;

  const dateSelect = (date) => {
    var tempDate = date.replace(/-/gi, "");
    const tempArr = {
      brandId: stockValue.brandId,
      totalProduct: stockValue.totalProduct,
      priceMin: stockValue.priceMin,
      priceMax: stockValue.priceMax,
      status: stockValue.status,
      date: tempDate,
      color: stockValue.color,
    };
    setStockValue(tempArr);
  };

  const clickedLoadMore = () => {
    var tempTotal = stockValue.totalProduct + 12;

    const tempArr = {
      brandId: stockValue.brandId,
      totalProduct: tempTotal,
      priceMin: stockValue.priceMin,
      priceMax: stockValue.priceMax,
      status: stockValue.status,
      date: stockValue.date,
      sortBy: stockValue.sortBy,
      color: stockValue.color,
    };
    setStockValue(tempArr);

    setDataLength({ min: 0, max: tempTotal });
  };

  const reset = () => {
    setresetClick(true);
    const tempArr = {
      brandId: stockValue.brandId,
      totalProduct: 12,
      priceMin: 0,
      priceMax: 500,
      status: "instock",
      date: "",
      sortBy: "",
      color: "",
    };
    setStockValue(tempArr);
    setchoosedate("--");

    setDataLength({ min: 0, max: 12 });
    setPriceRange({ min: 0, max: 500 });
    setTimeout(() => {
      setresetClick(false);
    }, 100);
  };
  const [selectColor, setSelectColor] = useState("");
  // colour filter
  const colorChange = (color) => {
    const tempArr = {
      brandId: stockValue.brandId,
      totalProduct: stockValue.totalProduct,
      priceMin: stockValue.priceMin,
      priceMax: stockValue.priceMax,
      status: stockValue.status,
      date: stockValue.date,
      sortBy: stockValue.sortBy,
      color: color,
    };
    setStockValue(tempArr);
    setSelectColor(color);
  };

  const [date, setDate] = useState([
    {
      startDate: new Date(),
      endDate: addDays(new Date(), 7),
      key: "selection",
    },
  ]);

  const {
    onOpen: OnDateOpen,
    onClose: onDateClose,
    isOpen: isDateOpen,
  } = useDisclosure();
  const demoArr = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];

  const pageData = state.source.get(state.router.link);
  const finalSlug = pageData && pageData.query.s;

  let prodTitle = finalSlug && finalSlug.split("+").join(" ");
  let finalTitle = finalSlug && prodTitle.toUpperCase();
  //console.log("product title =", finalTitle);
  return (
    <>
      <Stack mx={{ base: "6", md: "16", lg: "40" }}>
        <div className="fastsole-InstantSearch">
          <InstantSearch searchClient={searchClient} indexName="wp_posts_sneaker">
            <header className="App-header searchBoxPage">
              <SearchBox defaultRefinement={finalTitle} autoFocus translations={{ placeholder: 'Search Product' }} />
            </header>
            <Stack >

              <Grid templateColumns={{ lg: "3fr 9fr", sm: "repeat(1, 1fr)" }} textColor="#3E485D" gap={4}>
                <Stack id="filter-header-search" display={{ base: "block", md: "block", lg: "none" }}>
                  <main className="container" ref={containerRef}>
                    <section className="container-filters" onKeyUp={onKeyUp}>
                      <Box p={4} className="mobile-filter-drawer">

                        <Heading display="block" fontSize={{ base: "sm", md: "sm", lg: "xl" }} fontStyle="normal" color="#3E485D" lineHeight="27px">
                          Status
                        </Heading>
                        <RefinementList attribute="taxonomies.status" />

                        <Heading display="block" fontSize={{ base: "sm", md: "sm", lg: "lg" }} fontStyle="normal" color="#3E485D" lineHeight="27px">
                          Colors
                        </Heading>
                        <RefinementList attribute="taxonomies.colour" />

                        <Heading display="block" fontSize={{ base: "sm", md: "sm", lg: "lg" }} fontStyle="normal" color="#3E485D" lineHeight="27px">
                          Brands
                        </Heading>
                        <RefinementList attribute="taxonomies.department" />

                        <Box className="filters_btn_row">
                          <ClearRefinements className="reset_btn" translations={{ reset: 'Reset' }} />
                          <button className="filters-button" data-action="open-overlay" onClick={closeFilters}>Close Filters</button>
                        </Box>
                      </Box>
                    </section>
                  </main>
                  <aside data-layout="mobile">
                    <button className="filters-button" data-action="open-overlay" onClick={openFilters}>
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 14">
                        <path
                          d="M15 1H1l5.6 6.3v4.37L9.4 13V7.3z"
                          stroke="#fff"
                          strokeWidth="1.29"
                          fill="none"
                          fillRule="evenodd"
                          strokeLinecap="round"
                          strokeLinejoin="round"
                        />
                      </svg>
                      Filters
                    </button>
                  </aside>

                </Stack>
                <Box display={{ base: "none", md: "none", lg: "block" }}>
                  <div className="left-panel">

                    <Heading display="block" fontSize={{ base: "sm", md: "sm", lg: "xl" }} fontStyle="normal" color="#3E485D" lineHeight="27px">
                      Status
                    </Heading>
                    <RefinementList attribute="taxonomies.status" />

                    <Heading display="block" fontSize={{ base: "sm", md: "sm", lg: "lg" }} fontStyle="normal" color="#3E485D" lineHeight="27px">
                      Brands
                    </Heading>
                    <RefinementList attribute="taxonomies.department" />

                    <Heading display="block" fontSize={{ base: "sm", md: "sm", lg: "lg" }} fontStyle="normal" color="#3E485D" lineHeight="27px">
                      Colors
                    </Heading>
                    <RefinementList attribute="taxonomies.colour" />
                    <Configure hitsPerPage={8} />
                    <div className="reset_btn">
                      <Icon as={FaUndo} boxSize={3} mr={2} /><ClearRefinements className="webResetbtn" translations={{ reset: 'Reset' }} />
                    </div>
                  </div>
                </Box>
                <GridItem rowSpan={2} colSpan={1}>
                  <div className="right-panel">
                    <Box>
                      <div className="hitsperpage">
                        <HitsPerPage defaultRefinement={12} items={[
                          { value: 12, label: 'Show 12 hits' },
                          { value: 24, label: 'Show 24 hits' },
                          { value: 36, label: 'Show 36 hits' },
                        ]} />
                      </div>
                      <Hits hitComponent={Hit} />
                      <Pagination showLast />
                    </Box>
                  </div>
                </GridItem>
              </Grid>
            </Stack>
          </InstantSearch>
        </div>
        {/* calender */}
        <Modal isOpen={isDateOpen} onClose={onDateClose} size="md">
          <ModalOverlay />
          <ModalContent>
            <DateRangePicker
              months={2}
              onChange={(item) => {
                setDate([item.selection]);
              }}
              moveRangeOnFirstSelection={false}
              ranges={date}
              direction="vertical"
            />

            <ModalFooter>
              <Button
                colorScheme="teal"
                size="sm"
                variant="solid"
                onClick={() => {
                  // setisCalender(!isCalender);
                  const firstdate = date[0].startDate;
                  const enddatedate = date[0].endDate;
                  exactDate(firstdate, enddatedate);

                  onDateClose();
                  window.scrollTo(0, 0);
                }}
              >
                Apply
              </Button>
            </ModalFooter>
          </ModalContent>
        </Modal>
        {/* Mobile Filter OLD */}
        {/* <Stack id="filter-header">
          <Flex
            justifyContent={{
              base: "space-between",
              md: "space-between",
              lg: "flex-end",
            }}
          >
            <Select
              placeholder="Sort By"
              fontSize="xs"
              colorScheme="#9DA7BE"
              color="#3E485D"
              size="sm"
              w={100}
              variant="outline"
              onChange={(event) => shortDropDown(event.target.value)}

            >
              <option value="priceLowToHigh">Price low to high</option>
              <option value="priceHighToLow">High to low</option>
              <option value="releseDateDesc">
                Order by release date (DESC)
              </option>

              <option value="releaseThisWeek">Release this week</option>
            </Select>

            <Icon
              as={FaSlidersH}
              boxSize="7"
              p="1"
              border="2px solid #9DA7BE"
              colorScheme="#9DA7BE"
              color="#3E485D"
              borderRadius={4}
              display={{ base: "block", md: "block", lg: "none" }}
              onClick={onOpen}
            />


            <Box
              isOpen={isOpen}
              placement="right"
              onClose={onClose}
              display="none"
            >
              <Drawer
                isOpen={isOpen}
                placement="right"
                onClose={onClose}
                finalFocusRef={btnRef}
              >
                <DrawerOverlay />
                <DrawerContent>
                  <DrawerCloseButton />
                  <DrawerHeader
                    bg="#d8dee7"
                    color="#3E485D"
                    fontSize={{ base: "sm", md: "sm", lg: "sm" }}
                    fontStyle="normal"
                  >
                    Filter
                  </DrawerHeader>

                  <DrawerBody color="#3E485D">
                    <Box p={4}>


                      <Heading
                        display="block"
                        fontSize={{ base: "sm", md: "sm", lg: "sm" }}
                        fontStyle="normal"
                        color="#3E485D"
                        lineHeight="27px"
                      >
                        Stock
                      </Heading>

                      <RadioGroup
                        onChange={setStockValue}
                        value={stockValue}
                        my={2}
                      >
                        <VStack
                          color="#525F7A"
                          alignItems="flex-start"
                          fontStyle="normal"
                          lineHeight="19px"
                        >
                          <Radio
                            size="sm"
                            value="instock"
                            onChange={(event) => {
                              stockChange(event.target.value);
                              onClose();
                            }}
                          >
                            In Stock
                          </Radio>
                          <Radio
                            size="sm"
                            value="comingsoon"
                            onChange={(event) => {
                              stockChange(event.target.value);
                              onClose();
                            }}
                          >
                            Coming soon
                          </Radio>
                          <Radio
                            size="sm"
                            value="soldout"
                            onChange={(event) => {
                              stockChange(event.target.value);
                              onClose();
                            }}
                          >
                            Sold out
                          </Radio>
                        </VStack>
                      </RadioGroup>


                      <Heading
                        display="block"
                        fontSize={{ base: "sm", md: "sm", lg: "sm" }}
                        fontStyle="normal"
                        color="#3E485D"
                        lineHeight="27px"
                      >
                        Price Range
                      </Heading>

                      <Flex width="85%">
                        <Text color="#7887A5" mr={3}>
                          {priceRange.min}
                        </Text>
                        {
                          <RangeSlider
                            aria-label={["min", "max"]}
                            colorScheme="green"
                            defaultValue={[priceRange.min, priceRange.max]}
                            min={0}
                            max={500}
                            step={30}
                            onChangeEnd={(val) => rangeSlider(val)}
                          >
                            <RangeSliderTrack>
                              <RangeSliderFilledTrack />
                            </RangeSliderTrack>
                            <RangeSliderThumb index={0} />
                            <RangeSliderThumb index={1} />
                          </RangeSlider>
                        }
                        <Text color="#7887A5" ml={2}>
                          {priceRange.max}
                        </Text>
                      </Flex>

                      <Button
                        colorScheme="#525F7A"
                        bg="#525F7A"
                        color=" white"
                        size="xs"
                        p={3}
                        mt={3}
                        h="30px"
                        w="100px"
                        onClick={() => {
                          reset();
                          onClose();
                        }}
                      >
                        <Icon as={FaUndo} boxSize={3} mr={2} /> Reset
                      </Button>
                    </Box>
                  </DrawerBody>
                </DrawerContent>
              </Drawer>
            </Box>

          </Flex>
        </Stack> */}
        {/* Mobile Filter OLD */}

        {/* PHP Filter Code - 9th Nov 2022 */}
        {/* <Stack className="PHP-FILTER">
          <Grid templateColumns={{ lg: "3fr 9fr", sm: "repeat(1, 1fr)" }} textColor="white" gap={4}>
            <Box display={{ base: "none", md: "none", lg: "block" }}>
              <Box p={4} border="1px solid #9DA7BE" rounded="lg">
                <Heading display="block" fontSize={{ base: "sm", md: "sm", lg: "sm" }} fontStyle="normal" color="#3E485D" lineHeight="27px">
                  Release calender
                </Heading>

                <InputGroup my={2} size="md" onClick={() => { OnDateOpen() }}>
                  <Input pr="2.5rem" type="text" placeholder="pick a date" />
                  <InputRightElement width="4.5rem">
                    <MdDateRange />
                  </InputRightElement>
                </InputGroup>

                <Heading display="block" fontSize={{ base: "sm", md: "sm", lg: "sm" }} fontStyle="normal" color="#3E485D" lineHeight="27px">
                  Stock
                </Heading>

                <RadioGroup defaultValue="instock" my={2}>
                  <VStack color="#525F7A" alignItems="flex-start" fontStyle="normal" lineHeight="19px" fontWeight="normal" colorScheme="blue">
                    <Radio size="sm" value="instock" onChange={(event) => stockChange(event.target.value)}>
                      In Stock
                    </Radio>
                    <Radio size="sm" value="comingsoon" onChange={(event) => stockChange(event.target.value)}>
                      Coming soon
                    </Radio>
                    <Radio size="sm" value="soldout" onChange={(event) => stockChange(event.target.value)}>
                      Sold out
                    </Radio>
                  </VStack>
                </RadioGroup>

                <Heading display="block" fontSize={{ base: "sm", md: "sm", lg: "sm" }} fontStyle="normal" color="#3E485D" lineHeight="27px">
                  Price Range
                </Heading>

                <Flex width="85%">
                  <Text color="#7887A5" mr={3}>
                    {priceRange.min}
                  </Text>
                  {resetClick == true ? (
                    <div></div>
                  ) : (
                    <RangeSlider aria-label={["min", "max"]} colorScheme="green" defaultValue={[priceRange.min, priceRange.max]} min={0} max={500} step={30} onChangeEnd={(val) => rangeSlider(val)}>
                      <RangeSliderTrack>
                        <RangeSliderFilledTrack />
                      </RangeSliderTrack>
                      <RangeSliderThumb index={0} />
                      <RangeSliderThumb index={1} />
                    </RangeSlider>
                  )}
                  <Text color="#7887A5" ml={3}>
                    {priceRange.max}
                  </Text>
                </Flex>

                <Button colorScheme="#525F7A" rounded="3px" bg="#525F7A" color=" white" size="xs" h="35px" w="100px" p={3} mt={3} onClick={() => reset()}>
                  <Icon as={FaUndo} boxSize={3} mr={2} /> Reset
                </Button>
              </Box>
            </Box>

            <Box>
              <Box>
                {!state.sneakerReleaseDates.isLoading ? (
                  (filterItems && filterItems.length === 0) ||
                    filterItems === undefined ? (
                    <NoProduct />
                  ) : (
                    <Grid templateColumns={{ md: "1fr 1fr 1fr 1fr", base: "repeat(2, 1fr)", }} gap={4} mb="10">
                      {console.log("items data ", filterItems)}
                      {Object.values(filterItems)
                        .slice(dataLength.min, dataLength.max)
                        .map((item) => {
                          if (item.sneaker_status === "instock") {
                            var status = (
                              <Text color="#3EB75E" fontSize="xs" lineHeight="22px">
                                <Icon as={FaCheckCircle} boxSize="3" mr={1} color={"#3EB75E"} />
                                In Stock
                              </Text>
                            );
                          } else if (item.sneaker_status == "coming_soon") {
                            var status = (
                              <Text color="#FF6600" fontSize="xs" lineHeight="22px">
                                <Icon as={FaClock} boxSize="3" mr={1} color={"#FF6600"} />
                                Coming Soon
                              </Text>
                            );
                          } else if (
                            item.sneaker_status == "stockist_in_stock"
                          ) {
                            var status = (
                              <Text color="#FF6600" fontSize="xs" lineHeight="22px">
                                <Icon as={FaClock} boxSize="3" mr={1} color={"#FF6600"} />
                                Stocklist In Stock
                              </Text>
                            );
                          } else if (item.sneaker_status == "restock") {
                            var status = (
                              <Text color="#FF6600" fontSize="xs" lineHeight="22px">
                                <Icon as={FaClock} boxSize="3" mr={1} color={"#FF6600"} />
                                Re Stock
                              </Text>
                            );
                          } else if (item.sneaker_status == "delayed") {
                            var status = (
                              <Text color="#FF6600" fontSize="xs" lineHeight="22px">
                                <Icon as={FaClock} boxSize="3" mr={1} color={"#FF6600"} />
                                Delayed
                              </Text>
                            );
                          } else if (item.sneaker_status == "sold_out") {
                            var status = (
                              <Text color="#FF6600" fontSize="xs" lineHeight="22px">
                                <Icon as={FaClock} boxSize="3" mr={1} color={"#FF6600"} />
                                Sold Out
                              </Text>
                            );
                          } else if (
                            item.sneaker_status == "stockist_sold_out"
                          ) {
                            var status = (
                              <Text color="#FF6600" fontSize="xs" lineHeight="22px">
                                <Icon as={FaClock} boxSize="3" mr={1} color={"#FF6600"} />
                                Stocklist Sold Out
                              </Text>
                            );
                          } else {
                            var status = (
                              <Text color="#FF6600" fontSize="xs" lineHeight="22px">
                                <Icon as={FaClock} boxSize="3" mr={1} color={"#FF6600"} />
                                Nothing
                              </Text>
                            );
                          }
                          return (
                            <Box p={2} border="1px solid #9DA7BE" rounded="lg">
                              <Text color="#525F7A" fontSize="xs" textAlign="center" mb={2} noOfLines={1}>
                                {item.release_date}
                              </Text>
                              <Link link={item.slug}>
                                <Box w={"100%"} overflow={"hidden"}>
                                  <img id="product-img" width="100%" height="100%" src={item.featured_image.large} lineHeight="22px" />
                                </Box>
                              </Link>

                              {status}

                              <Box height="42">
                                <Text as="h3" fontWeight="600" color="#3E485D" fontSize="xs" lineHeight="22px" fontStyle="normal" noOfLines={2}>
                                  <Box>
                                    <Link link={item.slug}>
                                      {item.post_title}
                                    </Link>
                                  </Box>
                                </Text>
                              </Box>
                              <Text fontWeight="bold" color="#525F7A" fontSize="xs" lineHeight="22px">
                                £{item.price}
                              </Text>

                              <Link link={item.slug} style={{ textDecoration: "none" }}>
                                <Button lineHeight="22px" size="xs" color="#3E485D" variant="unstyled" border="1px solid #9DA7BE" w={"full"} h="30px" my={2} rounded="3" _hover={{ bg: "#525F7A", color: " white" }}>
                                  View Now
                                </Button>
                              </Link>
                            </Box>
                          );
                        })}
                    </Grid>
                  )
                ) : (
                  <Grid templateColumns={{ md: "1fr 1fr 1fr 1fr", base: "repeat(2, 1fr)" }} gap={4} mb="10">
                    {demoArr.map((data) => {
                      return <Productskeleton />;
                    })}
                  </Grid>
                )}

                {(filterItems && filterItems.length === 0) ||
                  filterItems === undefined ||
                  filterItems === "" ? (
                  <div></div>
                ) : (
                  <Box display={{ base: "block", md: "none" }}>
                    <Text color={"#3E485D"} display="flex" alignItems="center" justifyContent="center" fontSize="sm" lineHeight="26px" fontWeight="bold" onClick={() => clickedLoadMore()} cursor="default">
                      Load more
                    </Text>
                    <Text color={"#3E485D"} display="flex" alignItems="center" justifyContent="center" fontSize="sm" lineHeight="26px">
                      <Icon as={ArrowDownIcon} boxSize={4} mx={2} />
                    </Text>
                  </Box>
                )}

                {(filterItems && filterItems.length === 0) ||
                  filterItems === undefined ||
                  filterItems === "" ? (
                  <div></div>
                ) : (
                  <Box
                    display={{ base: "none", md: "flex" }}
                    justifyContent="center">
                    <span>
                      <Circle p="2" border="1px solid #9DA7BE" _hover={{ bg: "#3E485D !important" }} mr={2}>
                        <FaAngleDoubleLeft color="#9DA7BE" boxSize="2" onClick={() => doubleLeft()} />
                      </Circle>
                    </span>
                    <span>
                      <Circle p="2" border="1px solid #9DA7BE" _hover={{ bg: "#3E485D !important" }}>
                        <FaChevronLeft color="#9DA7BE" boxSize="2" onClick={currentPage === 1 ? "null" : goToPreviousPage} />
                      </Circle>
                    </span>
                    {
                      console.log("current page new:", currentPage)
                    }
                    {getPaginationGroup().map((item, index) => (
                      <Circle h="35px" w="35px"
                        bg={currentPage === item ? "#3E485D" : null} p="2"
                        border="1px solid #9DA7BE"
                        _hover={{ bg: "#3E485D !important" }}
                        color={currentPage === item ? "white" : "#9DA7BE"}
                        cursor="default" ml={2}>
                        <span key={index} onClick={changePage}>
                          {item}
                        </span>
                      </Circle>
                    ))}

                    <span>
                      <Circle p="2" border="1px solid #9DA7BE" _hover={{ bg: "#3E485D !important" }} ml={2}>
                        <FaChevronRight color="#9DA7BE" boxSize="2" onClick={currentPage === pages ? "null" : goToNextPage} />
                      </Circle>
                    </span>
                    <span>
                      <Circle p="2" border="1px solid #9DA7BE" _hover={{ bg: "#3E485D !important" }} ml={2}>
                        <FaAngleDoubleRight color="#9DA7BE" boxSize="2" onClick={() => doubleRight()} />
                      </Circle>
                    </span>
                  </Box>
                )}
              </Box>
            </Box>
          </Grid>
        </Stack> */}
        {/* PHP Filter Code - 9th Nov 2022 */}
      </Stack>
    </>
  );
};

export default connect(SearchResult);
