import Product from '@/features/product/components';
import 'regenerator-runtime/runtime';
import { IProduct } from '@/features/product/components/interface';
import { useEffect, useState } from 'react';
import CancelButton from './cancelButton';
import Common from './common';
import Group from './group';
import { IFormHandlers, IUnitValue, IValidations } from './group.interface';
import { Type } from './group.type';
import SaveButton from './saveButton';
import TypeSwitcher from './typeSwitcher';
import Wrapper from './wrapper';
import { UNIT_TYPE } from '@/features/product/components/interface';
import { unitMap } from '../constants/product';
import RefreshButton from './refreshButton';
import './styles.scss';
import { ProductProvider } from '@/features/product/services/productProvider';
import { ISkuModel } from '../models/sku';
import { INameModel } from '../models/name';
import { IPriceModel } from '../models/price';
import { IUnitValueModel } from '../models/unitValue';
import { validateText } from '../validation/text';
import { validateNumber } from '../validation/number';
import { validateUnitValue } from '../validation/unitValue';
import * as Sentry from '@sentry/react';

/**
 * Product add form component.
 *
 * This component will be in charge of displaying a form with the id
 * #product_form. It will contain the following fields:
 * SKU (id: #sku)
 * Name (id: #name)
 * Price (id: #price)
 * Product type switcher (id: #productType) with following options:
 *   DVD (can be value or text)
 *   Book (can be value or text)
 *   Furniture (can be value or text)
 * Product type-specific attribute
 *   Size input field (in MB) for DVD-disc should have an ID: #size
 *   Weight input field (in Kg) for Book should have an ID: #weight
 *   Each from Dimensions input fields (HxWxL) for Furniture should
 *     have an appropriate ID:
 *     Height - #height
 *     Width - #width
 *     Length - #length
 */
const ProductAddForm = (): JSX.Element => {
  // assign default sku value to the placeholder of the sku input
  const [sku, setSku] = useState<ISkuModel>({
    value: 'SKU',
    isValid: false,
    error: 'Invalid SKU.',
  });
  const [name, setName] = useState<INameModel>({
    value: 'Name',
    isValid: false,
    error: 'Invalid name.',
  });
  const [price, setPrice] = useState<IPriceModel>({
    value: '0',
    isValid: false,
    error: 'Invalid price.',
  });
  const [type, setType] = useState<Type>('DISC');
  const [unitValue, setUnitValue] = useState<IUnitValueModel>({
    value: '0',
    isValid: false,
    error: 'Invalid value(s).',
  });

  const handleSku = (event: React.ChangeEvent<HTMLInputElement>): void => {
    const { value, placeholder } = event.target;

    setSku({
      value: value || placeholder,
      isValid: validateText(value),
      error: sku.error,
    });
  };

  const handleName = (event: React.ChangeEvent<HTMLInputElement>): void => {
    const { value, placeholder } = event.target;

    setName({
      value: value || placeholder,
      isValid: validateText(value),
      error: name.error,
    });
  };

  const handlePrice = (event: React.ChangeEvent<HTMLInputElement>): void => {
    const { value, placeholder } = event.target;

    setPrice({
      value: value || placeholder,
      isValid: validateNumber(value),
      error: price.error,
    });
  };

  const handleUnitValue = (_unitValue: IUnitValue): void => {
    const { FURNITURE } = _unitValue;
    const { length, width, height } = FURNITURE;

    const combinedDimensions = `${length}x${width}x${height}`;

    if (type === 'FURNITURE') {
      setUnitValue({
        value: combinedDimensions,
        isValid: validateUnitValue(combinedDimensions, 'FURNITURE'),
        error: unitValue.error,
      });
    }
    if (type === 'BOOK') {
      setUnitValue({
        value: _unitValue.BOOK.weight || '0',
        isValid: validateUnitValue(_unitValue.BOOK.weight, 'BOOK'),
        error: unitValue.error,
      });
    }
    if (type === 'DISC') {
      setUnitValue({
        value: _unitValue.DISC.size || '0',
        isValid: validateUnitValue(_unitValue.DISC.size, 'DISC'),
        error: unitValue.error,
      });
    }
  };

  const handleType = (event: React.ChangeEvent<HTMLSelectElement>): void => {
    setType(event.target.value as Type);
  };

  const inputHandlers: IFormHandlers = {
    sku: handleSku,
    name: handleName,
    price: handlePrice,
    type: handleType,
    unitValue: handleUnitValue,
  };

  const [product, setProduct] = useState<IProduct>({} as IProduct);

  useEffect(() => {
    // set up product
    const product: IProduct = {
      product_id: -1,
      sku: sku.value,
      name: name.value,
      currency: 'USD',
      price: price.value,
      type: type,
      unit: unitMap[type],
      unit_value: unitValue.value,
    };
    setProduct(product);
  }, [name, price, sku, type, unitValue]);

  const updateSku = (_sku: string): void => {
    setSku({
      value: _sku,
      isValid: validateText(_sku),
      error: sku.error,
    });
  };

  const unit = UNIT_TYPE[type];
  const formProduct = { sku, name, price, type, unit, unitValue };

  const handleSubmit = (e: React.ChangeEvent<HTMLFormElement>): void => {
    e.preventDefault();

    // check if sku, name, price, and unitValue are valid.
    // if they are, then submit the product to the server
    if (sku.isValid && name.isValid && price.isValid && unitValue.isValid) {
      saveProduct().then((): void => {
        window.location.href = '/';
      });
    } else {
      Sentry.captureMessage('Invalid product.');
    }
  };

  const saveProduct = async (): Promise<void> => {
    // getProducts and fetch length
    const products = await ProductProvider.getProducts();
    // get id of the last product in the list
    const id =
      products.length > 0 ? products[products.length - 1].product_id : 1;

    const newProduct = {
      ...product,
      product_id: id + 1,
    };
    await ProductProvider.createProduct(newProduct);
  };

  const validations: IValidations = {
    sku: {
      isValid: sku.isValid,
      error: sku.error,
    },
    name: {
      isValid: name.isValid,
      error: name.error,
    },
    price: {
      isValid: price.isValid,
      error: price.error,
    },
    unitValue: {
      isValid: unitValue.isValid,
      error: unitValue.error,
    },
  };
  //
  // usestate for checked
  const [checked, setChecked] = useState(false);

  // div className="product" should have an onClick function that calls setChecked
  const handleClick = (): void => {
    setChecked(!checked);
  };

  // WCAG 2.1.1 onKeyDown
  const handleKeyDown = (event: React.KeyboardEvent<HTMLDivElement>): void => {
    if (event.key === 'Enter') {
      setChecked(!checked);
    }
  };

  return (
    <Wrapper>
      <div className="product-submit-container">
        <Product
          checked={checked}
          handleClick={handleClick}
          handleKeyDown={handleKeyDown}
          className="product-preview"
          product={product}
        />
        <div className="button-container">
          <SaveButton />
          <CancelButton />
          <RefreshButton />
        </div>
      </div>
      <div className="product-form-container">
        <form
          className="product-form"
          onSubmit={handleSubmit}
          id="product_form"
          noValidate
        >
          <Common
            validations={validations}
            updateSku={updateSku}
            handlers={inputHandlers}
          />
          <TypeSwitcher handlers={inputHandlers} />
          <Group
            validations={validations}
            product={formProduct}
            handlers={inputHandlers}
          />
        </form>
      </div>
    </Wrapper>
  );
};

export default ProductAddForm;
